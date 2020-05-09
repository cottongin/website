<?php

namespace App\Crawling;

use App\Entity\Episode;
use Doctrine\ORM\EntityManagerInterface;
use Http\Client\Common\HttpMethodsClient;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;

class EpisodeShownotesCrawler
{
    use LoggerAwareTrait;

    private $entityManager;
    private $httpClient;

    public function __construct(EntityManagerInterface $entityManager, HttpMethodsClient $shownotesClient)
    {
        $this->entityManager = $entityManager;
        $this->httpClient = $shownotesClient;
        $this->logger = new NullLogger();
    }

    public function crawl(Episode $episode): void
    {
        libxml_use_internal_errors(true);

        $frontResponse = $this->httpClient->get(sprintf('http://%s.noagendanotes.com', $episode->getCode()));

        $data['url'] = $frontResponse->getHeaderLine('Location');

        $htmlResponse = $this->httpClient->get($data['url']);
        $htmlContents = $htmlResponse->getBody()->getContents();

        $htmlDom = new \DOMDocument();
        $htmlDom->loadHTML($htmlContents);

        $htmlXpath = new \DOMXPath($htmlDom);

        $url = $htmlXpath->query('.//link[@title="OPML"]')->item(0)->getAttribute('href');

        $response = $this->httpClient->get($url);
        $contents = $response->getBody()->getContents();

        $shownotesPath = sprintf('%s/shownotes/%s.xml', $_SERVER['APP_STORAGE_PATH'], $episode->getCode());
        file_put_contents($shownotesPath, $contents);

        $episode->setShownotesUri($data['url']);

        $this->entityManager->persist($episode);
    }
}

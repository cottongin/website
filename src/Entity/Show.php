<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShowRepository")
 * @ORM\Table(name="show_table")
 */
class Show
{
    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=15)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @var \DateTimeInterface
     *
     * @ORM\Column(type="date")
     */
    private $publishedAt;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $coverUri;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $recordingUri;

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
    private $crawlerOutput;

    public function isPersisted(): bool
    {
        return $this->id !== null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getPublishedAt(): \DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getCoverUri(): string
    {
        return $this->coverUri;
    }

    public function setCoverUri(string $coverUri): self
    {
        $this->coverUri = $coverUri;

        return $this;
    }

    public function getRecordingUri(): string
    {
        return $this->recordingUri;
    }

    public function setRecordingUri(string $recordingUri): self
    {
        $this->recordingUri = $recordingUri;

        return $this;
    }

    public function getCrawlerOutput(): array
    {
        return $this->crawlerOutput;
    }

    public function setCrawlerOutput(array $crawlerOutput): self
    {
        $this->crawlerOutput = $crawlerOutput;

        return $this;
    }
}

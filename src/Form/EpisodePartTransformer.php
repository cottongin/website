<?php
/*
 * This file is part of the Onlinq library.
 *
 * (c) Onlinq <info@onlinq.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Form;

use App\Repository\EpisodePartRepository;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class EpisodePartTransformer implements DataTransformerInterface
{
    private $repository;

    public function __construct(EpisodePartRepository $repository)
    {
        $this->repository = $repository;
    }

    public function transform($part)
    {
        if (null === $part) {
            return '';
        }

        return $part->getId();
    }

    public function reverseTransform($id)
    {
        if (!$id) {
            return null;
        }

        $part = $this->repository->find($id);

        if (null === $part) {
            throw new TransformationFailedException('Invalid episode part.');
        }

        return $part;
    }
}
<?php

declare(strict_types=1);

/*
 * This file is part of the CyclePath project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Mutators;

use App\Interactors\ImageInteractor;
use Doctrine\ORM\EntityManagerInterface;
use App\Builders\Interfaces\ImageBuilderInterface;
use App\Mutators\Interfaces\ImageMutatorInterface;

/**
 * Class ImageMutator.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class ImageMutator implements ImageMutatorInterface
{
    /**
     * @var ImageBuilderInterface
     */
    private $imageBuilderInterface;

    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * ImageMutator constructor.
     *
     * @param ImageBuilderInterface  $imageBuilderInterface
     * @param EntityManagerInterface $entityManagerInterface
     */
    public function __construct(
        ImageBuilderInterface $imageBuilderInterface,
        EntityManagerInterface $entityManagerInterface
    ) {
        $this->imageBuilderInterface = $imageBuilderInterface;
        $this->entityManagerInterface = $entityManagerInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function removeImage(\ArrayAccess $arguments): array
    {
        $image = $this->entityManagerInterface
                      ->getRepository(ImageInteractor::class)
                      ->findOneBy([
                          'id' => $arguments->offsetGet('id'),
                      ]);

        $this->entityManagerInterface->remove($image);
        $this->entityManagerInterface->flush();

        return [
            $image,
        ];
    }
}

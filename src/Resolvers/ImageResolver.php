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

namespace App\Resolvers;

use App\Interactors\ImageInteractor;
use Doctrine\ORM\EntityManagerInterface;
use App\Resolvers\Interfaces\ImageResolverInterface;

/**
 * Class ImageResolver
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ImageResolver implements ImageResolverInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * ImageResolver constructor.
     *
     * @param EntityManagerInterface $entityManagerInterface
     */
    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManagerInterface = $entityManagerInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function getImages(\ArrayAccess $arguments)
    {
        if ($arguments->offsetExists('id')) {
            return [
                $this->entityManagerInterface
                     ->getRepository(ImageInteractor::class)
                     ->findOneBy([
                          'id' => $arguments->offsetGet('id')
                     ])
            ];
        }

        return $this->entityManagerInterface
                    ->getRepository(ImageInteractor::class)
                    ->findAll();
    }
}

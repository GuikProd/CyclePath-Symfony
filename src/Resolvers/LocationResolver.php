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

use App\Interactors\LocationInteractor;
use Doctrine\ORM\EntityManagerInterface;
use App\Resolvers\Interfaces\LocationResolverInterface;

/**
 * Class LocationResolver
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class LocationResolver implements LocationResolverInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * LocationResolver constructor.
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
    public function getLocations(\ArrayAccess $arguments)
    {
        if ($arguments->offsetExists('id')) {
            return [
                $this->entityManagerInterface
                     ->getRepository(LocationInteractor::class)
                     ->findOneBy([
                         'id' => $arguments->offsetGet('id')
                     ])
            ];
        }

        return $this->entityManagerInterface
                    ->getRepository(LocationInteractor::class)
                    ->findAll();
    }
}

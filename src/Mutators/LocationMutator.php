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

use App\Interactors\PathInteractor;
use App\Interactors\LocationInteractor;
use Doctrine\ORM\EntityManagerInterface;
use App\Mutators\Interfaces\LocationMutatorInterface;
use App\Builders\Interfaces\LocationBuilderInterface;

/**
 * Class LocationMutator
 * 
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class LocationMutator implements LocationMutatorInterface
{
    /**
     * @var LocationBuilderInterface
     */
    private $locationBuilder;

    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * LocationMutator constructor.
     *
     * @param LocationBuilderInterface $locationBuilder
     * @param EntityManagerInterface $entityManagerInterface
     */
    public function __construct(
        LocationBuilderInterface $locationBuilder,
        EntityManagerInterface $entityManagerInterface
    ) {
        $this->locationBuilder = $locationBuilder;
        $this->entityManagerInterface = $entityManagerInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function addLocation(\ArrayAccess $arguments): array
    {
        $path = $this->entityManagerInterface
                     ->getRepository(PathInteractor::class)
                     ->findOneBy([
                         'id' => $arguments->offsetGet('pathId')
                     ]);

        $this->locationBuilder
             ->create()
             ->withTimestamp($arguments->offsetGet('timestamp'))
             ->withLatitude($arguments->offsetGet('latitude'))
             ->withLongitude($arguments->offsetGet('longitude'))
             ->withAltitude($arguments->offsetGet('altitude'))
             ->withPath($path)
        ;

        $this->entityManagerInterface->persist($this->locationBuilder->build());
        $this->entityManagerInterface->flush();

        return [
            $this->locationBuilder
                 ->build()
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function removeLocations(\ArrayAccess $arguments): array
    {
        $locations = $this->entityManagerInterface
                          ->getRepository(LocationInteractor::class)
                          ->findBy([
                              'path' => $arguments->offsetGet('pathId')
                          ]);

        foreach ($locations as $location) {
            $this->entityManagerInterface
                 ->remove($location);
        }

        $this->entityManagerInterface
             ->flush();
    }
}

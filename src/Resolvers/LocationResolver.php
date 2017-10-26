<?php

/*
 * This file is part of the CyclePath project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Resolvers;

use App\Models\Location;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

/**
 * Class LocationResolver
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class LocationResolver implements ResolverInterface
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
     * @param Argument $argument
     *
     * @return Location[]|array
     */
    public function getLocations(Argument $argument)
    {
        if ($argument->offsetExists('id')) {
            return [
                $this->entityManagerInterface->getRepository(Location::class)
                                             ->findOneBy([
                                                 'id' => $argument->offsetGet('id')
                                             ])
            ];
        }

        return $this->entityManagerInterface->getRepository(Location::class)->findAll();
    }
}

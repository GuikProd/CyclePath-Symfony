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

namespace App\Repository;

use App\Interactors\PathInteractor;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Repository\Interfaces\PathGatewayInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * Class PathRepository.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class PathRepository extends ServiceEntityRepository implements PathGatewayInterface
{
    /**
     * PathRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PathInteractor::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getUserPaths(int $uuid): array
    {
        return $this->createQueryBuilder('paths')
                    ->where('paths.user = :user')
                    ->setParameter('user', $uuid)
                    ->setCacheable(true)
                    ->getQuery()
                    ->getArrayResult();
    }
}

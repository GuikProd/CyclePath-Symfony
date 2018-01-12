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

use App\Interactors\BadgeInteractor;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Repository\Interfaces\BadgeGatewayInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * Class BadgeRepository.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BadgeRepository extends ServiceEntityRepository implements BadgeGatewayInterface
{
    /**
     * BadgeRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BadgeInteractor::class);
    }
}

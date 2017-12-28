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

use App\Interactors\BadgeInteractor;
use Doctrine\ORM\EntityManagerInterface;
use App\Builders\Interfaces\BadgeBuilderInterface;
use App\Resolvers\Interfaces\BadgeResolverInterface;

/**
 * Class BadgeResolver.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BadgeResolver implements BadgeResolverInterface
{
    /**
     * @var BadgeBuilderInterface
     */
    private $badgeBuilderInterface;

    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * BadgeResolver constructor.
     *
     * @param BadgeBuilderInterface  $badgeBuilderInterface
     * @param EntityManagerInterface $entityManagerInterface
     */
    public function __construct(
        BadgeBuilderInterface $badgeBuilderInterface,
        EntityManagerInterface $entityManagerInterface
    ) {
        $this->badgeBuilderInterface = $badgeBuilderInterface;
        $this->entityManagerInterface = $entityManagerInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function getBadges(\ArrayAccess $arguments)
    {
        if (isset($arguments['id'])) {
            return [
                $this->entityManagerInterface
                     ->getRepository(BadgeInteractor::class)
                     ->findOneBy([
                          'id' => $arguments['id'],
                     ]),
            ];
        }

        return $this->entityManagerInterface
                    ->getRepository(BadgeInteractor::class)
                    ->findAll();
    }
}

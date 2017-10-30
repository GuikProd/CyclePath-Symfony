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

use App\Models\Badge;
use Doctrine\ORM\EntityManagerInterface;
use App\Resolvers\Interfaces\BadgeResolverInterface;

/**
 * Class BadgeResolver
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BadgeResolver implements BadgeResolverInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * BadgeResolver constructor.
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
    public function getBadges(\ArrayAccess $arguments)
    {
        if (isset($arguments['id'])) {
            return [
                $this->entityManagerInterface->getRepository(Badge::class)
                                             ->findOneBy([
                                                 'id' => $arguments['id']
                                             ])
            ];
        }

        return $this->entityManagerInterface->getRepository(Badge::class)->findAll();
    }

    /**
     * @inheritdoc}
     */
    public function createBadge(\ArrayAccess $arguments)
    {
        // TODO: Implement createBadge() method.
    }
}

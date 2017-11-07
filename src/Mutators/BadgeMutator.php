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

use App\Models\Badge;
use Doctrine\ORM\EntityManagerInterface;
use App\Builders\Interfaces\BadgeBuilderInterface;
use App\Mutators\Interfaces\BadgeMutatorInterface;

/**
 * Class BadgeMutator
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BadgeMutator implements BadgeMutatorInterface
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
     * BadgeMutator constructor.
     *
     * @param BadgeBuilderInterface $badgeBuilderInterface
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
    public function createBadge(\ArrayAccess $arguments)
    {
        $this->badgeBuilderInterface
             ->create()
             ->withLabel((string) $arguments->offsetGet('label'))
             ->withLevel((int) $arguments->offsetGet('level'))
             ->withObtentionDate(new \DateTime())
        ;

        $this->entityManagerInterface->persist($this->badgeBuilderInterface->build());
        $this->entityManagerInterface->flush();

        return $this->entityManagerInterface
                    ->getRepository(Badge::class)
                    ->findOneBy([
                        'label' => $this->badgeBuilderInterface->build()->getLabel()
                    ]);
    }

    /**
     * {@inheritdoc}
     */
    public function updateBadge(\ArrayAccess $arguments)
    {
        $badge = $this->entityManagerInterface
                      ->getRepository(Badge::class)
                      ->findOneBy([
                          'id' => (int) $arguments->offsetGet('id')
                      ]);

        switch ($arguments) {
            case $arguments->offsetExists('label') && $arguments->offsetExists('level'):
                $this->badgeBuilderInterface
                     ->setBadge($badge)
                     ->withLabel((string) $arguments->offsetGet('label'))
                     ->withLevel((int) $arguments->offsetGet('level'))
                     ->build()
                ;

                $this->entityManagerInterface->flush();

                return $this->badgeBuilderInterface->build();

                break;
            case $arguments->offsetExists('label'):
                $this->badgeBuilderInterface
                     ->setBadge($badge)
                     ->withLabel((string) $arguments->offsetGet('label'))
                     ->build()
                ;

                $this->entityManagerInterface->flush();

                return $this->badgeBuilderInterface->build();

                break;
            case $arguments->offsetExists('level'):
                $this->badgeBuilderInterface
                     ->setBadge($badge)
                     ->withLevel((int) $arguments->offsetGet('level'))
                     ->build()
                ;

                $this->entityManagerInterface->flush();

                return $this->badgeBuilderInterface->build();

                break;
            default:
                return $this->entityManagerInterface
                            ->getRepository(Badge::class)
                            ->findOneBy([
                                'id' => (int) $arguments->offsetGet('id')
                            ]);
                break;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeBadge(\ArrayAccess $arguments)
    {
        if ($arguments->offsetExists('userId')) {

            $badge = $this->entityManagerInterface
                          ->getRepository(Badge::class)
                          ->findOneBy([
                              'user' => $arguments->offsetGet('userId')
                          ]);

            $this->entityManagerInterface->remove($badge);
            $this->entityManagerInterface->flush();
        }

        $object = $this->entityManagerInterface
                       ->getRepository(Badge::class)
                       ->findOneBy([
                           'id' => $arguments->offsetGet('id')
                       ]);

        $this->entityManagerInterface->remove($object);
        $this->entityManagerInterface->flush();

        return $object;
    }
}

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
    public function createBadge(array $arguments)
    {
        $this->badgeBuilderInterface
             ->create()
             ->withLabel((string) $arguments['label'])
             ->withLevel((int) $arguments['level'])
        ;

        $this->entityManagerInterface->persist($this->badgeBuilderInterface->build());
        $this->entityManagerInterface->flush();

        return $this->entityManagerInterface->getRepository(Badge::class)
                                            ->findOneBy([
                                                'label' => $this->badgeBuilderInterface->build()->getLabel()
                                            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function updateBadge(array $arguments)
    {
        // TODO: Implement updateBadge() method.
    }

    /**
     * {@inheritdoc}
     */
    public function removeBadge(array $arguments)
    {
        if (isset($arguments['userId'])) {

            $badge = $this->entityManagerInterface->getRepository(Badge::class)
                                                  ->findOneBy([
                                                      'user' => $arguments['userId']
                                                  ]);

            $this->entityManagerInterface->remove($badge);
            $this->entityManagerInterface->flush();
        }

        $object = $this->entityManagerInterface->getRepository(Badge::class)
                                     ->findOneBy([
                                         'id' => $arguments['id']
                                     ]);

        $this->entityManagerInterface->remove($object);
        $this->entityManagerInterface->flush();

        return $object;
    }
}

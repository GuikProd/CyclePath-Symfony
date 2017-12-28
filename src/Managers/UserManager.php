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

namespace App\Managers;

use App\Models\Interfaces\UserInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Managers\Interfaces\UserManagerInterface;

/**
 * Class UserManager.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class UserManager implements UserManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * UserManager constructor.
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
    public function save(UserInterface $user): void
    {
        $this->entityManagerInterface->persist($user);
        $this->entityManagerInterface->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function update(UserInterface $user): void
    {
        $this->entityManagerInterface->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(UserInterface $user): void
    {
        $this->entityManagerInterface->remove($user);
        $this->entityManagerInterface->flush();
    }
}

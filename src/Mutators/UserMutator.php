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

use App\Models\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Mutators\Interfaces\UserMutatorInterface;

/**
 * Class UserMutator
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserMutator implements UserMutatorInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * UserMutator constructor.
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
    public function updateUser(\ArrayAccess $arguments)
    {
        // TODO: Implement updateUser() method.
    }

    /**
     * {@inheritdoc}
     */
    public function removeUser(\ArrayAccess $arguments)
    {
        $user = $this->entityManagerInterface
                     ->getRepository(User::class)
                     ->findOneBy([
                         'id' => $arguments->offsetGet('id')
                     ]);

        $this->entityManagerInterface->remove($user);
        $this->entityManagerInterface->flush();

        return $user;
    }
}

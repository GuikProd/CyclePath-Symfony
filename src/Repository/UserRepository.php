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

use Doctrine\ORM\EntityRepository;
use App\Interactors\UserInteractor;
use App\Gateway\Interfaces\UserGatewayInterface;

/**
 * Class UserRepository.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserRepository extends EntityRepository implements UserGatewayInterface
{
    /**
     * {@inheritdoc}
     */
    public function getUserById(int $uuid):? UserInteractor
    {
        return $this->createQueryBuilder('user')
                    ->where('user.id = :id')
                    ->setParameter('id', $uuid)
                    ->setCacheable(true)
                    ->getQuery()
                    ->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function getUserByUsername(string $username):? UserInteractor
    {
        return $this->createQueryBuilder('user')
                    ->where('user.username = :username')
                    ->setParameter('username', $username)
                    ->setCacheable(true)
                    ->getQuery()
                    ->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function getUserByEmail(string $email):? UserInteractor
    {
        return $this->createQueryBuilder('user')
                    ->where('user.email = :email')
                    ->setParameter('email', $email)
                    ->setCacheable(true)
                    ->getQuery()
                    ->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function getUserWithImage(int $uuid)
    {
        return $this->createQueryBuilder('user')
                    ->where('user.id = :id')
                    ->setParameter('id', $uuid)
                    ->innerJoin('user.image', 'image')
                    ->getQuery()
                    ->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function getUserWithPaths(int $uuid)
    {
        return $this->createQueryBuilder('user')
                    ->where('user.id = :id')
                    ->setParameter('id', $uuid)
                    ->innerJoin('user.paths', 'paths')
                    ->getQuery()
                    ->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function getUserWithBadges(int $uuid)
    {
        return $this->createQueryBuilder('user')
                    ->where('user.id = :id')
                    ->setParameter('id', $uuid)
                    ->innerJoin('user.badges', 'badges')
                    ->getQuery()
                    ->getResult();
    }
}

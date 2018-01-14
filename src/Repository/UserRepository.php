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

use App\Interactors\UserInteractor;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Repository\Interfaces\UserGatewayInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * Class UserRepository.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserRepository extends ServiceEntityRepository implements UserGatewayInterface, UserLoaderInterface
{
    /**
     * UserRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserInteractor::class);
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('user')
                    ->where('user.username = :username OR user.email = :email')
                    ->setParameter('username', $username)
                    ->setParameter('email', $username)
                    ->getQuery()
                    ->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function getUsers(): array
    {
        return $this->createQueryBuilder('user')
                    ->setCacheable(true)
                    ->getQuery()
                    ->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function getUserById(int $uuid): ? UserInteractor
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
    public function getUserByUsername(string $username): ? UserInteractor
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
    public function getUserByEmail(string $email): ? UserInteractor
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
    public function getUserByUsernameAndEmail(string $username, string $email): ? UserInteractor
    {
        return $this->createQueryBuilder('user')
                    ->where('user.username = :username')
                    ->setParameter('username', $username)
                    ->andWhere('user.email = :email')
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

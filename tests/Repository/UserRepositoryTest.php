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

namespace App\Tests\Repository;

use App\Interactors\UserInteractor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class UserRepositoryTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserRepositoryTest extends KernelTestCase
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManagerInterface = $kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

    public function testGetUserById()
    {
        static::assertEquals(
            null,
            $this->entityManagerInterface
                 ->getRepository(UserInteractor::class)
                 ->getUserById(1000000)
        );
    }

    public function testGetUserByUsername()
    {
        static::assertEquals(
            null,
            $this->entityManagerInterface
                 ->getRepository(UserInteractor::class)
                 ->getUserByUsername('Hey')
        );
    }

    public function testGetUserByEmail()
    {
        static::assertEquals(
            null,
            $this->entityManagerInterface
                 ->getRepository(UserInteractor::class)
                 ->getUserByEmail('hey@gmail.com')
        );
    }

    public function testGetUserWithImages()
    {
        static::assertEquals(
            [],
            $this->entityManagerInterface
                 ->getRepository(UserInteractor::class)
                 ->getUserWithImage(1000000)
        );
    }

    public function testGetUserWithPaths()
    {
        static::assertEquals(
            [],
            $this->entityManagerInterface
                 ->getRepository(UserInteractor::class)
                 ->getUserWithPaths(1000000)
        );
    }

    public function testGetUserWithBadges()
    {
        static::assertEquals(
            [],
            $this->entityManagerInterface
                 ->getRepository(UserInteractor::class)
                 ->getUserWithBadges(1000000)
        );
    }
}

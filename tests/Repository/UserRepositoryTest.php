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

use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use App\Models\Interfaces\UserInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UserRepositoryTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserRepositoryTest extends TestCase
{
    public function testGetUserById()
    {
        $entityManagerMock = $this->getMockBuilder(EntityManagerInterface::class)
                                  ->disableOriginalConstructor()
                                  ->getMock();

        $classMetaDataMock = $this->getMockBuilder(ClassMetadata::class)
                                  ->disableOriginalConstructor()
                                  ->getMock();

        $userMock = $this->getMockBuilder(UserInterface::class)
                         ->disableOriginalConstructor()
                         ->getMock();

        $repository = new UserRepository($entityManagerMock, $classMetaDataMock);

        $userMock->expects(static::once())->method('getId')->willReturn(0);

        static::assertSame(
            [],
            $repository->getUserById($userMock->getId())
        );
    }

    public function testGetUserWithImages()
    {
        $entityManagerMock = $this->getMockBuilder(EntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $classMetaDataMock = $this->getMockBuilder(ClassMetadata::class)
            ->disableOriginalConstructor()
            ->getMock();

        $userMock = $this->getMockBuilder(UserInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $repository = new UserRepository($entityManagerMock, $classMetaDataMock);

        $userMock->expects(static::once())->method('getId')->willReturn(0);

        static::assertSame(
            [],
            $repository->getUserWithImage($userMock->getId())
        );
    }
}

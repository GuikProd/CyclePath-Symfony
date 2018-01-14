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
use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use App\Repository\Interfaces\UserGatewayInterface;

/**
 * Class UserRepositoryTest.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserRepositoryTest extends TestCase
{
    public function testInstanceOf()
    {
        $entityManagerMock = $this->getMockBuilder(EntityManager::class)
                                  ->disableOriginalConstructor()
                                  ->getMock();

        $metadataMock = $this->getMockBuilder(ClassMetadata::class)
                             ->disableOriginalConstructor()
                             ->getMock();

        $repository = new UserRepository($entityManagerMock, $metadataMock);

        static::assertInstanceOf(
            UserGatewayInterface::class,
            $repository
        );
    }
}

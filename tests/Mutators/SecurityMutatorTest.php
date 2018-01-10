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

namespace App\Tests\Mutators;

use PHPUnit\Framework\TestCase;
use App\Mutators\SecurityMutator;
use App\Exceptions\GraphQLException;
use Doctrine\ORM\EntityManagerInterface;
use App\Loggers\Interfaces\CoreLoggerInterface;
use App\Builders\Interfaces\UserBuilderInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

/**
 * Class SecurityMutatorTest.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class SecurityMutatorTest extends TestCase
{
    public function testItShouldThrowAGraphQLExceptionWithoutArguments()
    {
        $userPasswordEncoderMock = $this->getMockBuilder(UserPasswordEncoderInterface::class)
                                        ->disableOriginalConstructor()
                                        ->getMock();

        $userBuilderMock = $this->getMockBuilder(UserBuilderInterface::class)
                                ->disableOriginalConstructor()
                                ->getMock();

        $entityManagerMock = $this->getMockBuilder(EntityManagerInterface::class)
                                  ->disableOriginalConstructor()
                                  ->getMock();

        $coreLoggerMock = $this->getMockBuilder(CoreLoggerInterface::class)
                               ->disableOriginalConstructor()
                               ->getMock();

        $jwtTokenManagerMock = $this->getMockBuilder(JWTTokenManagerInterface::class)
                                    ->disableOriginalConstructor()
                                    ->getMock();

        $eventDispatcherMock = $this->getMockBuilder(EventDispatcherInterface::class)
                                    ->disableOriginalConstructor()
                                    ->getMock();

        $securityMutator = new SecurityMutator(
            $userPasswordEncoderMock,
            $userBuilderMock,
            $entityManagerMock,
            $coreLoggerMock,
            $jwtTokenManagerMock,
            $eventDispatcherMock
        );

        $arrayAccessMock = $this->getMockBuilder(\ArrayAccess::class)
                                ->disableOriginalConstructor()
                                ->getMock();

        $this->expectException(GraphQLException::class);

        static::assertNull(
            $securityMutator->register($arrayAccessMock)
        );
    }

    public function testItShouldThrowAnErrorWithBadUsername()
    {
        $userPasswordEncoderMock = $this->getMockBuilder(UserPasswordEncoderInterface::class)
                                        ->disableOriginalConstructor()
                                        ->getMock();

        $userBuilderMock = $this->getMockBuilder(UserBuilderInterface::class)
                                ->disableOriginalConstructor()
                                ->getMock();

        $entityManagerMock = $this->getMockBuilder(EntityManagerInterface::class)
                                  ->disableOriginalConstructor()
                                  ->getMock();

        $coreLoggerMock = $this->getMockBuilder(CoreLoggerInterface::class)
                               ->disableOriginalConstructor()
                               ->getMock();

        $jwtTokenManagerMock = $this->getMockBuilder(JWTTokenManagerInterface::class)
                                    ->disableOriginalConstructor()
                                    ->getMock();

        $eventDispatcherMock = $this->getMockBuilder(EventDispatcherInterface::class)
                                    ->disableOriginalConstructor()
                                    ->getMock();

        $securityMutator = new SecurityMutator(
            $userPasswordEncoderMock,
            $userBuilderMock,
            $entityManagerMock,
            $coreLoggerMock,
            $jwtTokenManagerMock,
            $eventDispatcherMock
        );

        $arrayAccessMock = $this->createMock(\ArrayAccess::class);
        $arrayAccessMock->method('offsetGet')
                        ->willReturn([
                            'username' => 'Heygringo',
                        ]);

        $this->expectException(\Error::class);

        static::assertNull(
            $securityMutator->register($arrayAccessMock)
        );
    }
}

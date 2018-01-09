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

namespace spec\App\Mutators;

use PhpSpec\ObjectBehavior;
use App\Exceptions\GraphQLException;
use Doctrine\ORM\EntityManagerInterface;
use App\Loggers\Interfaces\CoreLoggerInterface;
use App\Builders\Interfaces\UserBuilderInterface;
use App\Mutators\Interfaces\SecurityMutatorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

/**
 * Class SecurityMutatorSpec.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class SecurityMutatorSpec extends ObjectBehavior
{
    /**
     * @param \PhpSpec\Wrapper\Collaborator|UserPasswordEncoderInterface $encoder
     * @param UserBuilderInterface|\PhpSpec\Wrapper\Collaborator         $userBuilder
     * @param EntityManagerInterface|\PhpSpec\Wrapper\Collaborator       $entityManager
     * @param CoreLoggerInterface|\PhpSpec\Wrapper\Collaborator          $coreLogger
     * @param JWTTokenManagerInterface|\PhpSpec\Wrapper\Collaborator     $JWTTokenManager
     * @param \PhpSpec\Wrapper\Collaborator|EventDispatcherInterface     $eventDispatcher
     */
    public function it_is_initializable(
        UserPasswordEncoderInterface $encoder,
        UserBuilderInterface $userBuilder,
        EntityManagerInterface $entityManager,
        CoreLoggerInterface $coreLogger,
        JWTTokenManagerInterface $JWTTokenManager,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->beConstructedWith($encoder, $userBuilder, $entityManager, $coreLogger, $JWTTokenManager, $eventDispatcher);
        $this->beAnInstanceOf(SecurityMutatorInterface::class);
    }

    /**
     * @param \PhpSpec\Wrapper\Collaborator|UserPasswordEncoderInterface $encoder
     * @param UserBuilderInterface|\PhpSpec\Wrapper\Collaborator         $userBuilder
     * @param EntityManagerInterface|\PhpSpec\Wrapper\Collaborator       $entityManager
     * @param CoreLoggerInterface|\PhpSpec\Wrapper\Collaborator          $coreLogger
     * @param JWTTokenManagerInterface|\PhpSpec\Wrapper\Collaborator     $JWTTokenManager
     * @param \PhpSpec\Wrapper\Collaborator|EventDispatcherInterface     $eventDispatcher
     * @param \ArrayAccess|\PhpSpec\Wrapper\Collaborator                 $arrayAccess
     */
    public function it_should_allow_registration(
        UserPasswordEncoderInterface $encoder,
        UserBuilderInterface $userBuilder,
        EntityManagerInterface $entityManager,
        CoreLoggerInterface $coreLogger,
        JWTTokenManagerInterface $JWTTokenManager,
        EventDispatcherInterface $eventDispatcher,
        \ArrayAccess $arrayAccess
    ) {
        $this->beConstructedWith($encoder, $userBuilder, $entityManager, $coreLogger, $JWTTokenManager, $eventDispatcher);
        $this->shouldThrow(GraphQLException::class)->during('register', [$arrayAccess]);
    }

    /**
     * @param \PhpSpec\Wrapper\Collaborator|UserPasswordEncoderInterface $encoder
     * @param UserBuilderInterface|\PhpSpec\Wrapper\Collaborator         $userBuilder
     * @param EntityManagerInterface|\PhpSpec\Wrapper\Collaborator       $entityManager
     * @param CoreLoggerInterface|\PhpSpec\Wrapper\Collaborator          $coreLogger
     * @param JWTTokenManagerInterface|\PhpSpec\Wrapper\Collaborator     $JWTTokenManager
     * @param \PhpSpec\Wrapper\Collaborator|EventDispatcherInterface     $eventDispatcher
     * @param \ArrayAccess|\PhpSpec\Wrapper\Collaborator                 $arrayAccess
     */
    public function it_should_allow_account_validation(
        UserPasswordEncoderInterface $encoder,
        UserBuilderInterface $userBuilder,
        EntityManagerInterface $entityManager,
        CoreLoggerInterface $coreLogger,
        JWTTokenManagerInterface $JWTTokenManager,
        EventDispatcherInterface $eventDispatcher,
        \ArrayAccess $arrayAccess
    ) {
        $this->beConstructedWith($encoder, $userBuilder, $entityManager, $coreLogger, $JWTTokenManager, $eventDispatcher);
        $this->shouldThrow(\Error::class)->during('validate', [$arrayAccess]);
    }

    /**
     * @param \PhpSpec\Wrapper\Collaborator|UserPasswordEncoderInterface $encoder
     * @param UserBuilderInterface|\PhpSpec\Wrapper\Collaborator         $userBuilder
     * @param EntityManagerInterface|\PhpSpec\Wrapper\Collaborator       $entityManager
     * @param CoreLoggerInterface|\PhpSpec\Wrapper\Collaborator          $coreLogger
     * @param JWTTokenManagerInterface|\PhpSpec\Wrapper\Collaborator     $JWTTokenManager
     * @param \PhpSpec\Wrapper\Collaborator|EventDispatcherInterface     $eventDispatcher
     * @param \ArrayAccess|\PhpSpec\Wrapper\Collaborator                 $arrayAccess
     */
    public function it_should_allow_login(
        UserPasswordEncoderInterface $encoder,
        UserBuilderInterface $userBuilder,
        EntityManagerInterface $entityManager,
        CoreLoggerInterface $coreLogger,
        JWTTokenManagerInterface $JWTTokenManager,
        EventDispatcherInterface $eventDispatcher,
        \ArrayAccess $arrayAccess
    ) {
        $this->beConstructedWith($encoder, $userBuilder, $entityManager, $coreLogger, $JWTTokenManager, $eventDispatcher);
        $this->shouldThrow(\Error::class)->during('login', [$arrayAccess]);
    }
}

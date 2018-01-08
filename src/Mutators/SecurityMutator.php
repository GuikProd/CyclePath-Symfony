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

use App\Interactors\UserInteractor;
use App\Exceptions\GraphQLException;
use App\Events\User\UserCreatedEvent;
use App\Events\User\UserValidatedEvent;
use Doctrine\ORM\EntityManagerInterface;
use App\Events\User\UserResetPasswordEvent;
use App\Events\User\UserForgotPasswordEvent;
use App\Loggers\Interfaces\CoreLoggerInterface;
use App\Builders\Interfaces\UserBuilderInterface;
use App\Mutators\Interfaces\SecurityMutatorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

/**
 * Class SecurityMutator.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class SecurityMutator implements SecurityMutatorInterface
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var UserBuilderInterface
     */
    private $userBuilderInterface;

    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * @var CoreLoggerInterface
     */
    private $graphqlLoggerInterface;

    /**
     * @var JWTTokenManagerInterface
     */
    private $jwtTokenManagerInterface;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcherInterface;

    /**
     * SecurityMutator constructor.
     *
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param UserBuilderInterface         $userBuilderInterface
     * @param EntityManagerInterface       $entityManagerInterface
     * @param CoreLoggerInterface          $graphqlLoggerInterface
     * @param JWTTokenManagerInterface     $jwtTokenManagerInterface
     * @param EventDispatcherInterface     $eventDispatcherInterface
     */
    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        UserBuilderInterface $userBuilderInterface,
        EntityManagerInterface $entityManagerInterface,
        CoreLoggerInterface $graphqlLoggerInterface,
        JWTTokenManagerInterface $jwtTokenManagerInterface,
        EventDispatcherInterface $eventDispatcherInterface
    ) {
        $this->passwordEncoder = $passwordEncoder;
        $this->userBuilderInterface = $userBuilderInterface;
        $this->entityManagerInterface = $entityManagerInterface;
        $this->graphqlLoggerInterface = $graphqlLoggerInterface;
        $this->jwtTokenManagerInterface = $jwtTokenManagerInterface;
        $this->eventDispatcherInterface = $eventDispatcherInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function register(\ArrayAccess $arguments)
    {
        switch ($arguments) {
            case !$arguments->offsetGet('email') || !$arguments->offsetGet('username') || !$arguments->offsetGet('password'):
                throw new GraphQLException(
                    \sprintf(
                        "The sent request is invalid, missing parameters !"
                    )
                );
                break;
            default:
                $username = $this->entityManagerInterface
                                 ->getRepository(UserInteractor::class)
                                 ->findOneBy([
                                     'username' => (string) $arguments->offsetGet('username')
                                 ]);

                $email = $this->entityManagerInterface
                              ->getRepository(UserInteractor::class)
                              ->findOneBy([
                                  'email' => (string) $arguments->offsetGet('email')
                              ]);

                if ($username || $email) {
                    throw new GraphQLException(
                        \sprintf(
                            'Oops, this credentials already exist !'
                        )
                    );
                }

                $this->userBuilderInterface
                     ->create()
                     ->withCreationDate(new \DateTime())
                     ->withUsername((string) $arguments->offsetGet('username'))
                     ->withEmail((string) $arguments->offsetGet('email'))
                     ->withPlainPassword((string) $arguments->offsetGet('password'))
                     ->withRole('ROLE_USER')
                     ->withValidated(false)
                     ->withActive(false)
                     ->withValidationToken(
                         crypt(
                             str_rot13(
                                 str_shuffle(
                                     $this->userBuilderInterface->build()->getEmail()
                                 )
                             ),
                             $this->userBuilderInterface->build()->getUsername()
                         )
                     )
                ;

                $this->userBuilderInterface->withPassword(
                    $this->passwordEncoder->encodePassword(
                        $this->userBuilderInterface->build(),
                        $this->userBuilderInterface->build()->getPlainPassword()
                    )
                );

                $this->entityManagerInterface->persist($this->userBuilderInterface->build());
                $this->entityManagerInterface->flush();

                $userCreatedEvent = new UserCreatedEvent(
                    $this->userBuilderInterface->build(),
                    'A new user has created an account.'
                );
                $this->eventDispatcherInterface->dispatch(UserCreatedEvent::NAME, $userCreatedEvent);

                return $this->entityManagerInterface
                            ->getRepository(UserInteractor::class)
                            ->getUserByUsername((string) $arguments->offsetGet('username'));
                break;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validate(\ArrayAccess $arguments)
    {
        $user = $this->entityManagerInterface
                     ->getRepository(UserInteractor::class)
                     ->findOneBy([
                         'email' => (string) $arguments->offsetGet('email'),
                         'validationToken' => (string) $arguments->offsetGet('validationToken'),
                     ]);

        if (!$user) {
            throw new GraphQLException(
                \sprintf(
                    'Oops, looks like this credentials aren\'t valid !'
                )
            );
        }

        $this->userBuilderInterface
             ->setUser($user)
             ->withValidated(true)
             ->withActive(true)
        ;

        $this->entityManagerInterface->flush();

        $userValidatedEvent = new UserValidatedEvent($user);
        $this->eventDispatcherInterface->dispatch($userValidatedEvent::NAME, $userValidatedEvent);

        $this->graphqlLoggerInterface->onUserLog(
            'An user has validate his account.',
            1
        );

        return $this->userBuilderInterface->build();
    }

    /**
     * {@inheritdoc}
     */
    public function login(\ArrayAccess $arguments)
    {
        $user = $this->entityManagerInterface
                     ->getRepository(UserInteractor::class)
                     ->getUserByEmail((string) $arguments->offsetGet('email'));

        if (!$user) {
            throw new GraphQLException(
                \sprintf(
                    'Oops, looks like this credentials does not exist !'
                )
            );
        }

        if ($this->passwordEncoder->isPasswordValid($user, (string) $arguments->offsetGet('password'))) {
            $token = $this->jwtTokenManagerInterface->create($user);

            $this->graphqlLoggerInterface->onSecurityLog(
                'An user has logged himself.',
                1
            );

            return $this->userBuilderInterface
                        ->setUser($user)
                        ->withApiToken($token)
                        ->build();
        }

        throw new GraphQLException(
            \sprintf(
                'Oops, looks like this credentials aren\'t valid !'
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function forgotPassword(\ArrayAccess $arguments)
    {
        $user = $this->entityManagerInterface
                     ->getRepository(UserInteractor::class)
                     ->findOneBy([
                         'email' => (string) $arguments->offsetGet('email'),
                         'username' => (string) $arguments->offsetGet('username'),
                     ]);

        if (!$user) {
            throw new GraphQLException(
                \sprintf(
                    'Oops, looks like this crendetials aren\'t valid ! Please check your entries.'
                )
            );
        }

        $this->userBuilderInterface
             ->setUser($user)
             ->withResetToken(
                 password_hash(
                     str_rot13(
                         str_shuffle(
                             $this->userBuilderInterface->build()->getEmail()
                         )
                     ),
                     PASSWORD_BCRYPT
                 )
             )
             ->build()
        ;

        $this->entityManagerInterface->flush();

        $userForgotPasswordEvent = new UserForgotPasswordEvent($this->userBuilderInterface->build());
        $this->eventDispatcherInterface->dispatch($userForgotPasswordEvent::NAME, $userForgotPasswordEvent);

        return $this->userBuilderInterface->build();
    }

    /**
     * {@inheritdoc}
     */
    public function resetPassword(\ArrayAccess $arguments)
    {
        $user = $this->entityManagerInterface
                     ->getRepository(UserInteractor::class)
                     ->findOneBy([
                         'email' => (string) $arguments->offsetGet('email'),
                         'resetToken' => (string) $arguments->offsetGet('resetToken'),
                     ]);

        if (!$user) {
            throw new GraphQLException(
                \sprintf(
                    'Oops, looks like this crendetials aren\'t valid ! Please check your entries.'
                )
            );
        }

        $this->userBuilderInterface
             ->setUser($user)
             ->withPlainPassword($arguments->offsetGet('password'))
             ->withResetToken('')
        ;

        $this->userBuilderInterface
             ->withPassword(
                 $this->passwordEncoder->encodePassword(
                     $this->userBuilderInterface->build(),
                     $this->userBuilderInterface->build()->getPlainPassword()
                 )
             )
             ->build()
        ;

        $this->entityManagerInterface->flush();

        $userResetPasswordEvent = new UserResetPasswordEvent($user);
        $this->eventDispatcherInterface->dispatch($userResetPasswordEvent::NAME, $userResetPasswordEvent);

        return $this->userBuilderInterface->build();
    }
}

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
use App\Events\UserCreatedEvent;
use App\Events\UserValidatedEvent;
use Doctrine\ORM\EntityManagerInterface;
use App\Builders\Interfaces\UserBuilderInterface;
use App\Mutators\Interfaces\SecurityMutatorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

/**
 * Class SecurityMutator
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class SecurityMutator implements SecurityMutatorInterface
{
    /**
     * @var UserBuilderInterface
     */
    private $userBuilderInterface;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var JWTTokenManagerInterface
     */
    private $jwtTokenManagerInterface;

    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcherInterface;

    /**
     * SecurityMutator constructor.
     *
     * @param UserBuilderInterface $userBuilderInterface
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param JWTTokenManagerInterface $jwtTokenManagerInterface
     * @param EntityManagerInterface $entityManagerInterface
     * @param EventDispatcherInterface $eventDispatcherInterface
     */
    public function __construct(
        UserBuilderInterface $userBuilderInterface,
        UserPasswordEncoderInterface $passwordEncoder,
        JWTTokenManagerInterface $jwtTokenManagerInterface,
        EntityManagerInterface $entityManagerInterface,
        EventDispatcherInterface $eventDispatcherInterface
    ) {
        $this->userBuilderInterface = $userBuilderInterface;
        $this->passwordEncoder = $passwordEncoder;
        $this->jwtTokenManagerInterface = $jwtTokenManagerInterface;
        $this->entityManagerInterface = $entityManagerInterface;
        $this->eventDispatcherInterface = $eventDispatcherInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function register(\ArrayAccess $arguments)
    {
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
                    )
                , $this->userBuilderInterface->build()->getUsername())
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

        $userCreatedEvent = new UserCreatedEvent($this->userBuilderInterface->build());
        $this->eventDispatcherInterface->dispatch($userCreatedEvent::NAME, $userCreatedEvent);

        return $this->entityManagerInterface
                    ->getRepository(User::class)
                    ->findOneBy([
                        'username' => $this->userBuilderInterface->build()->getUsername()
                    ]);
    }

    /**
     * {@inheritdoc}
     */
    public function validate(\ArrayAccess $arguments)
    {
        $user = $this->entityManagerInterface
                     ->getRepository(User::class)
                     ->findOneBy([
                         'email' => $arguments->offsetGet('email'),
                         'validationToken' => $arguments->offsetGet('validationToken')
                     ]);

        $this->userBuilderInterface
             ->setUser($user)
             ->withValidated(true)
             ->withActive(true)
        ;

        $this->entityManagerInterface->flush();

        $userValidatedEvent = new UserValidatedEvent($user);
        $this->eventDispatcherInterface->dispatch($userValidatedEvent::NAME, $userValidatedEvent);

        return $this->userBuilderInterface->build();
    }

    /**
     * {@inheritdoc}
     */
    public function login(\ArrayAccess $arguments)
    {
        $user = $this->entityManagerInterface
                     ->getRepository(User::class)
                     ->findOneBy([
                         'email' => $arguments->offsetGet('email')
                     ]);

        if ($this->passwordEncoder->isPasswordValid($user, $arguments->offsetGet('password'))) {

            $token = $this->jwtTokenManagerInterface->create($user);

            $this->userBuilderInterface
                 ->setUser($user)
                 ->withApiToken($token)
                 ->build()
            ;

            $this->entityManagerInterface->flush();

            return $this->userBuilderInterface->build();
        }

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function forgotPassword(\ArrayAccess $arguments)
    {
        $user = $this->entityManagerInterface
                     ->getRepository(User::class)
                     ->findOneBy([
                         'email' => $arguments->offsetGet('email'),
                         'username' => $arguments->offsetGet('username')
                     ]);

        $this->userBuilderInterface
             ->setUser($user)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function resetPassword(\ArrayAccess $arguments)
    {
        // TODO: Implement resetPassword() method.
    }
}

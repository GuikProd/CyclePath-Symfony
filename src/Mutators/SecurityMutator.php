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
use App\Builders\Interfaces\UserBuilderInterface;
use App\Mutators\Interfaces\SecurityMutatorInterface;
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
     * SecurityMutator constructor.
     *
     * @param UserBuilderInterface $userBuilderInterface
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param JWTTokenManagerInterface $jwtTokenManagerInterface
     * @param EntityManagerInterface $entityManagerInterface
     */
    public function __construct(
        UserBuilderInterface $userBuilderInterface,
        UserPasswordEncoderInterface $passwordEncoder,
        JWTTokenManagerInterface $jwtTokenManagerInterface,
        EntityManagerInterface $entityManagerInterface
    ) {
        $this->userBuilderInterface = $userBuilderInterface;
        $this->passwordEncoder = $passwordEncoder;
        $this->jwtTokenManagerInterface = $jwtTokenManagerInterface;
        $this->entityManagerInterface = $entityManagerInterface;
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
             ->withPassword((string) $arguments->offsetGet('password'))
             ->withRole('ROLE_USER')
             ->withValidated(false)
             ->withActive(false)
        ;

        $this->userBuilderInterface->withPassword(
            $this->passwordEncoder->encodePassword(
                $this->userBuilderInterface->build(),
                $this->userBuilderInterface->build()->getPlainPassword()
            )
        );

        $this->entityManagerInterface->persist($this->userBuilderInterface->build());
        $this->entityManagerInterface->flush();

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
    }
}

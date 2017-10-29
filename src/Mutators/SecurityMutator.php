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
use App\Builders\UserBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class SecurityMutator
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class SecurityMutator implements MutationInterface
{
    /**
     * @var UserBuilder
     */
    private $userBuilder;

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
     * @param UserBuilder $userBuilder
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param JWTTokenManagerInterface $jwtTokenManagerInterface
     * @param EntityManagerInterface $entityManagerInterface
     */
    public function __construct(
        UserBuilder $userBuilder,
        UserPasswordEncoderInterface $passwordEncoder,
        JWTTokenManagerInterface $jwtTokenManagerInterface,
        EntityManagerInterface $entityManagerInterface
    ) {
        $this->userBuilder = $userBuilder;
        $this->passwordEncoder = $passwordEncoder;
        $this->jwtTokenManagerInterface = $jwtTokenManagerInterface;
        $this->entityManagerInterface = $entityManagerInterface;
    }


    /**
     * @param Argument $argument
     *
     * @return User|null
     */
    public function registerUser(Argument $argument)
    {
        $this->userBuilder
             ->create()
             ->withCreationDate(new \DateTime())
             ->withUsername((string) $argument->offsetGet('username'))
             ->withEmail((string) $argument->offsetGet('email'))
             ->withPassword((string) $argument->offsetGet('password'))
             ->withRoles('ROLE_USER')
             ->withValidated(false)
             ->withActive(false)
        ;

        $this->userBuilder->withPassword(
            $this->passwordEncoder->encodePassword(
                $this->userBuilder->build(),
                $this->userBuilder->build()->getPlainPassword()
            )
        );

        $this->entityManagerInterface->persist($this->userBuilder->build());
        $this->entityManagerInterface->flush();

        return $this->entityManagerInterface->getRepository(User::class)->findOneBy([
                'username' => $this->userBuilder->build()->getUsername()
        ]);
    }

    public function loginUser(Argument $argument)
    {
        $user = $this->entityManagerInterface->getRepository(User::class)
                                             ->findOneBy([
                                                 'email' => $argument->offsetGet('email')
                                             ]);

        if ($this->passwordEncoder->isPasswordValid($user, $argument->offsetGet('password'))) {
            $token = $this->jwtTokenManagerInterface->create($user);
            $user->setApiToken($token);

            $this->entityManagerInterface->flush();

            return $this->entityManagerInterface->getRepository(User::class)->findOneBy([
                'username' => $this->userBuilder->build()->getUsername(),
                'apiToken' => $token
            ]);
        }
    }
}

<?php

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
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * SecurityMutator constructor.
     *
     * @param UserBuilder $userBuilder
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param EntityManagerInterface $entityManagerInterface
     */
    public function __construct(
        UserBuilder $userBuilder,
        UserPasswordEncoderInterface $passwordEncoder,
        EntityManagerInterface $entityManagerInterface
    ) {
        $this->userBuilder = $userBuilder;
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManagerInterface = $entityManagerInterface;
    }

    /**
     * @param Argument $argument
     *
     * @return User|null
     */
    public function registerUser(Argument $argument)
    {
        $this->userBuilder->create();
        $this->userBuilder->withCreationDate(new \DateTime());
        $this->userBuilder->withUsername($argument->offsetGet('username'));
        $this->userBuilder->withEmail($argument->offsetGet('email'));
        $this->userBuilder->withPassword($argument->offsetGet('password'));
        $this->userBuilder->withRoles('ROLE_USER');
        $this->userBuilder->withValidated(false);
        $this->userBuilder->withActive(false);

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
}

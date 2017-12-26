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

namespace spec\App\Handler;

use PhpSpec\ObjectBehavior;
use Doctrine\ORM\EntityManagerInterface;
use App\Handler\Interfaces\RegisterHandlerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class RegisterHandlerSpec
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class RegisterHandlerSpec extends ObjectBehavior
{
    /**
     * @param EntityManagerInterface|\PhpSpec\Wrapper\Collaborator $entityManager
     * @param \PhpSpec\Wrapper\Collaborator|UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function it_is_initializable(
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $userPasswordEncoder
    ) {
        $this->beConstructedWith($entityManager, $userPasswordEncoder);
        $this->shouldImplement(RegisterHandlerInterface::class);
    }
}

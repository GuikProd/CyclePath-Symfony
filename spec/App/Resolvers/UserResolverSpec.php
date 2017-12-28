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

namespace spec\App\Resolvers;

use PhpSpec\ObjectBehavior;
use Doctrine\ORM\EntityManagerInterface;
use App\Resolvers\Interfaces\UserResolverInterface;

/**
 * Class UserResolverSpec.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserResolverSpec extends ObjectBehavior
{
    /**
     * @param EntityManagerInterface|\PhpSpec\Wrapper\Collaborator $entityManager
     */
    public function it_is_initializable(EntityManagerInterface $entityManager)
    {
        $this->beConstructedWith($entityManager);
        $this->shouldImplement(UserResolverInterface::class);
    }

    public function it_should_return_null(EntityManagerInterface $entityManager, \ArrayAccess $arguments)
    {
        $this->beConstructedWith($entityManager);
        $this->getUsers($arguments)->shouldReturn(null);
    }
}

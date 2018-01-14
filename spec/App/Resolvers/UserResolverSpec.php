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
use App\Resolvers\Interfaces\UserResolverInterface;
use App\Repository\Interfaces\UserGatewayInterface;

/**
 * Class UserResolverSpec.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserResolverSpec extends ObjectBehavior
{
    /**
     * @param UserGatewayInterface|\PhpSpec\Wrapper\Collaborator $userGateway
     */
    public function it_is_initializable(UserGatewayInterface $userGateway)
    {
        $this->beConstructedWith($userGateway);
        $this->shouldImplement(UserResolverInterface::class);
    }
}

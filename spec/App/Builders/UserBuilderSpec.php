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

namespace spec\App\Builders;

use PhpSpec\ObjectBehavior;
use App\Models\Interfaces\UserInterface;
use App\Builders\Interfaces\UserBuilderInterface;

/**
 * Class UserBuilderSpec.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserBuilderSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(UserBuilderInterface::class);
    }

    public function should_return_user_interface()
    {
        $this->create()->shouldReturn(UserInterface::class);
    }

    /**
     * @param UserInterface $user
     */
    public function should_accept_user_interface_and_return_id(UserInterface $user)
    {
        $user->getId()->willReturn(10);

        $this->setUser($user)->shouldReturn(UserBuilderInterface::class);
        $this->build()->getId()->shouldReturn(10);
    }
}

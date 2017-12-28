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
use App\Models\Interfaces\BadgeInterface;
use App\Builders\Interfaces\BadgeBuilderInterface;

/**
 * Class BadgeBuilderSpec.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BadgeBuilderSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(BadgeBuilderInterface::class);
    }

    public function should_return_badge_interface()
    {
        $this->create()->shouldReturn(BadgeInterface::class);
    }

    /**
     * @param BadgeInterface $badge
     */
    public function should_accept_badge_interface_and_return_id(BadgeInterface $badge)
    {
        $badge->getId()->willReturn(100);

        $this->setBadge($badge)->shouldReturn(BadgeBuilderInterface::class);
        $this->build()->getId()->shouldReturn(100);
    }
}

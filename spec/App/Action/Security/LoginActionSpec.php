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

namespace spec\App\Action\Security;

use PhpSpec\ObjectBehavior;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class LoginActionSpec
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class LoginActionSpec extends ObjectBehavior
{
    /**
     * @param \PhpSpec\Wrapper\Collaborator|AuthenticationUtils $authenticationUtils
     */
    public function it_is_initializable(AuthenticationUtils $authenticationUtils)
    {
        $this->beConstructedWith($authenticationUtils);
    }
}

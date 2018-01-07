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

namespace spec\App\Responder\Security;

use Twig\Environment;
use PhpSpec\ObjectBehavior;

/**
 * Class LoginResponderSpec.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class LoginResponderSpec extends ObjectBehavior
{
    /**
     * @param \PhpSpec\Wrapper\Collaborator|Environment $twig
     */
    public function it_is_initializable(Environment $twig)
    {
        $this->beConstructedWith($twig);
    }
}

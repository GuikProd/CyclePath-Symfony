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

namespace App\Tests\Action\Security;

use PHPUnit\Framework\TestCase;
use App\Action\Security\LoginAction;
use App\Responder\Security\LoginResponder;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class LoginActionTest.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class LoginActionTest extends TestCase
{
    public function testReturnResponder()
    {
        $authenticationUtilsMock = $this->getMockBuilder(AuthenticationUtils::class)
                                         ->disableOriginalConstructor()
                                         ->getMock();

        $loginResponderMock = $this->getMockBuilder(LoginResponder::class)
                                    ->disableOriginalConstructor()
                                    ->getMock();

        $action = new LoginAction($authenticationUtilsMock);

        static::assertNull(
            $action($loginResponderMock)
        );
    }
}

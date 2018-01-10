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

namespace App\Tests\Responder\Security;

use Twig\Environment;
use PHPUnit\Framework\TestCase;
use App\Responder\Security\LoginResponder;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginResponderTest.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class LoginResponderTest extends TestCase
{
    public function testReturnResponse()
    {
        $twigMock = $this->getMockBuilder(Environment::class)
                         ->disableOriginalConstructor()
                         ->getMock();

        $responder = new LoginResponder($twigMock);

        static::assertInstanceOf(
            Response::class,
            $responder()
        );
    }
}

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
use App\Action\Security\RegisterAction;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use App\Responder\Security\RegisterResponder;
use Symfony\Component\Form\FormFactoryInterface;
use App\Builders\Interfaces\UserBuilderInterface;
use App\Handler\Interfaces\RegisterHandlerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class RegisterActionTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class RegisterActionTest extends TestCase
{
    public function testReturnResponder()
    {
        $sessionMock = $this->getMockBuilder(SessionInterface::class)
                            ->disableOriginalConstructor()
                            ->getMock();

        $requestMock = $this->getMockBuilder(Request::class)
                            ->disableOriginalConstructor()
                            ->getMock();

        $responderMock = $this->getMockBuilder(RegisterResponder::class)
                              ->disableOriginalConstructor()
                              ->getMock();

        $userBuilderMock = $this->getMockBuilder(UserBuilderInterface::class)
                                ->disableOriginalConstructor()
                                ->getMock();

        $formFactoryMock = $this->getMockBuilder(FormFactoryInterface::class)
                                ->disableOriginalConstructor()
                                ->getMock();

        $formInterfaceMock = $this->getMockBuilder(FormInterface::class)
                                  ->disableOriginalConstructor()
                                  ->getMock();

        $urlGeneratorMock = $this->getMockBuilder(UrlGeneratorInterface::class)
                                 ->disableOriginalConstructor()
                                 ->getMock();

        $registerHandlerMock = $this->getMockBuilder(RegisterHandlerInterface::class)
                                    ->disableOriginalConstructor()
                                    ->getMock();

        $eventDispatcherMock = $this->getMockBuilder(EventDispatcherInterface::class)
                                    ->disableOriginalConstructor()
                                    ->getMock();

        $formFactoryMock->method('create')->willReturn($formInterfaceMock);
        $formInterfaceMock->method('handleRequest')->willReturn($formInterfaceMock);
        $formInterfaceMock->method('createView')->willReturn(new FormView());

        $action = new RegisterAction(
            $userBuilderMock,
            $sessionMock,
            $formFactoryMock,
            $urlGeneratorMock,
            $registerHandlerMock,
            $eventDispatcherMock
        );

        static::assertNull(
            $action($requestMock, $responderMock)
        );
    }
}

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

use Symfony\Component\Form\FormView;
use Twig\Environment;
use PHPUnit\Framework\TestCase;
use App\Responder\Security\RegisterResponder;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RegisterResponderTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class RegisterResponderTest extends TestCase
{
    public function testReturnView()
    {
        $twigMock = $this->getMockBuilder(Environment::class)
                         ->disableOriginalConstructor()
                         ->getMock();

        $formViewMock = $this->getMockBuilder(FormView::class)
                             ->disableOriginalConstructor()
                             ->getMock();

        $responder = new RegisterResponder($twigMock);

        static::assertInstanceOf(
            Response::class,
            $responder($formViewMock)
        );
    }
}

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

namespace App\Tests\Action\Core;

use App\Action\Core\HomeAction;
use PHPUnit\Framework\TestCase;
use App\Responder\Core\HomeResponder;

/**
 * Class HomeActionTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class HomeActionTest extends TestCase
{
    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testActionReturn()
    {
        $responder = $this->getMockBuilder(HomeResponder::class)
                          ->disableOriginalConstructor()
                          ->getMock();

        $action = new HomeAction($responder);

        static::assertInstanceOf(
            HomeResponder::class,
            $action()
        );
    }
}

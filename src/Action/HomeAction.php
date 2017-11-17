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

namespace App\Action;

use App\Responder\HomeResponder;

/**
 * Class HomeAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class HomeAction
{
    /**
     * @var HomeResponder
     */
    private $responder;

    /**
     * HomeAction constructor.
     *
     * @param HomeResponder $responder
     */
    public function __construct(HomeResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * @return mixed
     */
    public function __invoke()
    {
        $responder = $this->responder;

        return $responder('core/index.html.twig', [
                'message' => 'Hello World from Vue and Symfony',
                'navigationTitle' => 'Home !',
                'footerTitle' => 'Home footer !'
            ]
        );
    }
}

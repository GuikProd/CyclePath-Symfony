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

namespace App\Action\Paths;

use App\Responder\Paths\PathsHomeResponder;

/**
 * Class PathsHomeAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class PathsHomeAction
{
    /**
     * @param PathsHomeResponder $responder
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(PathsHomeResponder $responder)
    {
        return $responder();
    }
}

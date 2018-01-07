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

namespace App\Responder\Paths;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PathsHomeResponder.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class PathsHomeResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * PathsHomeResponder constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param array $data
     *
     * @return Response $response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(array $data = [])
    {
        $response = new Response(
            $this->twig->render('Paths/index.html.twig', [
                'paths' => $data,
            ])
        );

        return $response->setCache([
            's_maxage' => 600,
        ]);
    }
}

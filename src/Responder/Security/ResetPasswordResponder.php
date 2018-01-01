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

namespace App\Responder\Security;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ResetPasswordResponder.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class ResetPasswordResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ResetPasswordResponder constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke()
    {
        $response = new Response(
            $this->twig->render('Security/resetPassword.html.twig')
        );

        return $response->setCache([
            's_maxage' => 200
        ]);
    }
}

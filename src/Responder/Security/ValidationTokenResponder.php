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
 * Class ValidationTokenResponder
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class ValidationTokenResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ValidationTokenResponder constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param null $errors
     *
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($errors = null)
    {
        return new Response(
            $this->twig->render('security/validationToken.html.twig', [
                'errors' => $errors
            ])
        );
    }
}

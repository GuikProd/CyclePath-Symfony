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
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RegisterResponder.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class RegisterResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * RegisterResponder constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param FormView $registerFormView
     *
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(FormView $registerFormView)
    {
        $response = new Response(
            $this->twig->render('security/register.html.twig', [
                'registerForm' => $registerFormView,
            ])
        );

        return $response->setCache([
            's_maxage' => 600,
        ]);
    }
}

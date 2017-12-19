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

namespace App\Responder\Dashboard;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class DashboardHomeResponder
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class DashboardHomeResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationCheckerInterface;

    /**
     * DashboardHomeResponder constructor.
     *
     * @param Environment $twig
     * @param AuthorizationCheckerInterface $authorizationCheckerInterface
     */
    public function __construct(
        Environment $twig,
        AuthorizationCheckerInterface $authorizationCheckerInterface
    ) {
        $this->twig = $twig;
        $this->authorizationCheckerInterface = $authorizationCheckerInterface;
    }

    /**
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @throws AccessDeniedException
     */
    public function __invoke()
    {
        if (!$this->authorizationCheckerInterface->isGranted('ROLE_USER')) {
            throw new AccessDeniedException(
                sprintf(
                    'You must be logged to access this page !'
                )
            );
        }

        return new Response(
            $this->twig->render('dashboard/home.html.twig')
        );
    }
}

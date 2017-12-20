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

namespace App\Responder\Core;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ContactResponder
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class ContactResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ContactResponder constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke()
    {
        return new Response(
            $this->twig->render('')
        );
    }
}

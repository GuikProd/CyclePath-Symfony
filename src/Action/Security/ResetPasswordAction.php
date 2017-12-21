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

namespace App\Action\Security;

use App\Responder\Security\ResetPasswordResponder;

/**
 * Class ResetPasswordAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class ResetPasswordAction
{
    public function __invoke(ResetPasswordResponder $responder)
    {
        return $responder();
    }
}

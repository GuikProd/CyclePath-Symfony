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

namespace App\Listeners;

use App\Events\UserCreatedEvent;

/**
 * Class UserListener
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserListener
{
    public function onUserCreated(UserCreatedEvent $event)
    {
        if (!$user = $event->getUser()) {
            return;
        }

        // TODO
        // Send an email to the user and validate his profile.
    }
}

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

namespace App\Subscribers\Interfaces;

use App\Events\User\UserCreatedEvent;

/**
 * Interface CoreSecuritySubscriberInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface CoreSecuritySubscriberInterface
{
    /**
     * @param UserCreatedEvent $event
     */
    public function onUserCreated(UserCreatedEvent $event): void;
}

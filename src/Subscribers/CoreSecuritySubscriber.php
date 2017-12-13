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

namespace App\Subscribers;

use App\Events\User\UserCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class CoreSecuritySubscriber
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class CoreSecuritySubscriber implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            UserCreatedEvent::NAME => 'onUserCreated'
        ];
    }

    public function onUserCreated()
    {

    }
}

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

namespace App\Events\User;

use App\Models\User;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class UserValidatedEvent
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserValidatedEvent extends Event
{
    const NAME = 'user.validated';

    /**
     * @var User
     */
    private $user;

    /**
     * UserValidatedEvent constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}

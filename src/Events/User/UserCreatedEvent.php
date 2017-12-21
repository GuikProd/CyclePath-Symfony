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

use App\Models\Interfaces\UserInterface;
use Symfony\Component\EventDispatcher\Event;
use App\Events\Interfaces\UserEventInterface;

/**
 * Class UserCreatedEvent
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class UserCreatedEvent extends Event implements UserEventInterface
{
    const NAME = 'user.created';

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * UserCreatedEvent constructor.
     *
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }
}

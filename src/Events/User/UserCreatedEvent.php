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
use App\Events\Interfaces\LoggerEventInterface;

/**
 * Class UserCreatedEvent.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserCreatedEvent extends Event implements UserEventInterface, LoggerEventInterface
{
    const NAME = 'user.created';

    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @var string
     */
    private $message;

    /**
     * UserCreatedEvent constructor.
     *
     * @param UserInterface $user
     * @param string        $message
     */
    public function __construct(
        UserInterface $user,
        string $message
    ) {
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }
}

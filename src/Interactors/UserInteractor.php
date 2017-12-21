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

namespace App\Interactors;

use App\Models\User;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Class UserInteractor
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserInteractor extends User implements AdvancedUserInterface, EquatableInterface
{
    /**
     * UserInteractor constructor.
     */
    public function __construct()
    {
        $this->paths = new ArrayCollection();
        $this->badges = new ArrayCollection();
    }

    /**
     * @codeCoverageIgnore
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * @codeCoverageIgnore
     */
    public function isAccountNonLocked()
    {
        return true;
    }

    /**
     * @codeCoverageIgnore
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * @codeCoverageIgnore
     */
    public function isEnabled()
    {
        return $this->active;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @codeCoverageIgnore
     */
    public function eraseCredentials()
    {
    }

    /**
     * @codeCoverageIgnore
     *
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
    }

    /**
     * @codeCoverageIgnore
     *
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password
            ) = unserialize($serialized);
    }

    /**
     * {@inheritdoc}
     */
    public function isEqualTo(UserInterface $user)
    {
        return $this->username === $user->getUsername();
    }
}

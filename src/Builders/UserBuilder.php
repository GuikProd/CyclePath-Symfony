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

namespace App\Builders;

use App\Interactors\UserInteractor;
use App\Models\Interfaces\PathInterface;
use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\BadgeInterface;
use App\Models\Interfaces\ImageInterface;
use App\Builders\Interfaces\UserBuilderInterface;

/**
 * Class UserBuilder
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class UserBuilder implements UserBuilderInterface
{
    /**
     * @var UserInterface
     */
    private $user;

    /**
     * {@inheritdoc}
     */
    public function create(): UserBuilderInterface
    {
        $this->user = new UserInteractor();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setUser(UserInterface $user): UserBuilderInterface
    {
        $this->user = $user;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withFirstname(string $firstname): UserBuilderInterface
    {
        $this->user->setFirstname($firstname);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withLastname(string $lastname): UserBuilderInterface
    {
        $this->user->setLastname($lastname);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withUsername(string $username): UserBuilderInterface
    {
        $this->user->setUsername($username);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withEmail(string $email): UserBuilderInterface
    {
        $this->user->setEmail($email);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withPlainPassword(string $plainPassword): UserBuilderInterface
    {
        $this->user->setPlainPassword($plainPassword);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withPassword(string $password): UserBuilderInterface
    {
        $this->user->setPassword($password);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withRole(string $role): UserBuilderInterface
    {
        $this->user->addRole($role);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withCreationDate(\DateTime $creationDate): UserBuilderInterface
    {
        $this->user->setCreationDate($creationDate);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withValidationDate(\DateTime $validationDate): UserBuilderInterface
    {
        $this->user->setValidationDate($validationDate);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withValidated(bool $validated): UserBuilderInterface
    {
        $this->user->setValidated($validated);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withActive(bool $active): UserBuilderInterface
    {
        $this->user->setActive($active);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withApiToken(string $apiToken): UserBuilderInterface
    {
        $this->user->setApiToken($apiToken);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withValidationToken(string $validationToken): UserBuilderInterface
    {
        $this->user->setValidationToken($validationToken);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withResetToken(string $resetToken): UserBuilderInterface
    {
        $this->user->setResetToken($resetToken);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withImage(ImageInterface $image): UserBuilderInterface
    {
        $this->user->setImage($image);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withBadge(BadgeInterface $badge): UserBuilderInterface
    {
        $this->user->addBadge($badge);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withPath(PathInterface $path): UserBuilderInterface
    {
        $this->user->addPath($path);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): UserInterface
    {
        return $this->user;
    }
}

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

namespace App\Builders\Interfaces;

use App\Models\Interfaces\PathInterface;
use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\BadgeInterface;
use App\Models\Interfaces\ImageInterface;

/**
 * Interface UserBuilderInterface.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface UserBuilderInterface
{
    /**
     * @return UserBuilderInterface
     */
    public function create(): self;

    /**
     * @param UserInterface $user
     *
     * @return UserBuilderInterface
     */
    public function setUser(UserInterface $user): self;

    /**
     * @param string $firstname
     *
     * @return UserBuilderInterface
     */
    public function withFirstname(string $firstname): self;

    /**
     * @param string $lastname
     *
     * @return UserBuilderInterface
     */
    public function withLastname(string $lastname): self;

    /**
     * @param string $username
     *
     * @return UserBuilderInterface
     */
    public function withUsername(string $username): self;

    /**
     * @param string $email
     *
     * @return UserBuilderInterface
     */
    public function withEmail(string $email): self;

    /**
     * @param string $plainPassword
     *
     * @return UserBuilderInterface
     */
    public function withPlainPassword(string $plainPassword): self;

    /**
     * @param string $password
     *
     * @return UserBuilderInterface
     */
    public function withPassword(string $password): self;

    /**
     * @param string $role
     *
     * @return UserBuilderInterface
     */
    public function withRole(string $role): self;

    /**
     * @param \DateTime $creationDate
     *
     * @return UserBuilderInterface
     */
    public function withCreationDate(\DateTime $creationDate): self;

    /**
     * @param \DateTime $validationDate
     *
     * @return UserBuilderInterface
     */
    public function withValidationDate(\DateTime $validationDate): self;

    /**
     * @param bool $validated
     *
     * @return UserBuilderInterface
     */
    public function withValidated(bool $validated): self;

    /**
     * @param bool $active
     *
     * @return UserBuilderInterface
     */
    public function withActive(bool $active): self;

    /**
     * @param string $apiToken
     *
     * @return UserBuilderInterface
     */
    public function withApiToken(string $apiToken): self;

    /**
     * @param string $validationToken
     *
     * @return UserBuilderInterface
     */
    public function withValidationToken(string $validationToken): self;

    /**
     * @param string $resetToken
     *
     * @return UserBuilderInterface
     */
    public function withResetToken(string $resetToken): self;

    /**
     * @param ImageInterface $image
     *
     * @return UserBuilderInterface
     */
    public function withImage(ImageInterface $image): self;

    /**
     * @param BadgeInterface $badge
     *
     * @return UserBuilderInterface
     */
    public function withBadge(BadgeInterface $badge): self;

    /**
     * @param PathInterface $path
     *
     * @return UserBuilderInterface
     */
    public function withPath(PathInterface $path): self;

    /**
     * @return UserInterface
     */
    public function build(): UserInterface;
}

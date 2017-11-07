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
 * Interface UserBuilderInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface UserBuilderInterface
{
    /**
     * @return UserBuilderInterface
     */
    public function create(): UserBuilderInterface;

    /**
     * @param UserInterface $user
     *
     * @return UserBuilderInterface
     */
    public function setUser(UserInterface $user): UserBuilderInterface;

    /**
     * @param string $firstname
     *
     * @return UserBuilderInterface
     */
    public function withFirstname(string $firstname): UserBuilderInterface;

    /**
     * @param string $lastname
     *
     * @return UserBuilderInterface
     */
    public function withLastname(string $lastname): UserBuilderInterface;

    /**
     * @param string $username
     *
     * @return UserBuilderInterface
     */
    public function withUsername(string $username): UserBuilderInterface;

    /**
     * @param string $email
     *
     * @return UserBuilderInterface
     */
    public function withEmail(string $email): UserBuilderInterface;

    /**
     * @param string $plainPassword
     *
     * @return UserBuilderInterface
     */
    public function withPlainPassword(string $plainPassword): UserBuilderInterface;

    /**
     * @param string $password
     *
     * @return UserBuilderInterface
     */
    public function withPassword(string $password): UserBuilderInterface;

    /**
     * @param string $role
     *
     * @return UserBuilderInterface
     */
    public function withRole(string $role): UserBuilderInterface;

    /**
     * @param \DateTime $creationDate
     *
     * @return UserBuilderInterface
     */
    public function withCreationDate(\DateTime $creationDate): UserBuilderInterface;

    /**
     * @param \DateTime $validationDate
     *
     * @return UserBuilderInterface
     */
    public function withValidationDate(\DateTime $validationDate): UserBuilderInterface;

    /**
     * @param bool $validated
     *
     * @return UserBuilderInterface
     */
    public function withValidated(bool $validated): UserBuilderInterface;

    /**
     * @param bool $active
     *
     * @return UserBuilderInterface
     */
    public function withActive(bool $active): UserBuilderInterface;

    /**
     * @param string $apiToken
     *
     * @return UserBuilderInterface
     */
    public function withApiToken(string $apiToken): UserBuilderInterface;

    /**
     * @param string $validationToken
     *
     * @return UserBuilderInterface
     */
    public function withValidationToken(string $validationToken): UserBuilderInterface;

    /**
     * @param string $resetToken
     *
     * @return UserBuilderInterface
     */
    public function withResetToken(string $resetToken): UserBuilderInterface;

    /**
     * @param ImageInterface $image
     *
     * @return UserBuilderInterface
     */
    public function withImage(ImageInterface $image): UserBuilderInterface;

    /**
     * @param BadgeInterface $badge
     *
     * @return UserBuilderInterface
     */
    public function withBadge(BadgeInterface $badge): UserBuilderInterface;

    /**
     * @param PathInterface $path
     *
     * @return UserBuilderInterface
     */
    public function withPath(PathInterface $path): UserBuilderInterface;

    /**
     * @return UserInterface
     */
    public function build(): UserInterface;
}

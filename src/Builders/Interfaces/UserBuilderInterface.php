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

use App\Models\User;

/**
 * Interface UserBuilderInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface UserBuilderInterface
{
    /**
     * @return $this
     */
    public function create();

    /**
     * @param User $user
     *
     * @return $this
     */
    public function setUser(User $user);

    /**
     * @param string $firstname
     *
     * @return $this
     */
    public function withFirstname(string $firstname);

    /**
     * @param string $lastname
     *
     * @return $this
     */
    public function withLastname(string $lastname);

    /**
     * @param string $username
     *
     * @return $this
     */
    public function withUsername(string $username);

    /**
     * @param string $email
     *
     * @return $this
     */
    public function withEmail(string $email);

    /**
     * @param string $plainPassword
     *
     * @return $this
     */
    public function withPlainPassword(string $plainPassword);

    /**
     * @param string $password
     *
     * @return $this
     */
    public function withPassword(string $password);

    /**
     * @param string $role
     *
     * @return $this
     */
    public function withRole(string $role);

    /**
     * @param \DateTime $creationDate
     *
     * @return $this
     */
    public function withCreationDate(\DateTime $creationDate);

    /**
     * @param \DateTime $validationDate
     *
     * @return $this
     */
    public function withValidationDate(\DateTime $validationDate);

    /**
     * @param bool $validated
     *
     * @return $this
     */
    public function withValidated(bool $validated);

    /**
     * @param bool $active
     *
     * @return $this
     */
    public function withActive(bool $active);

    /**
     * @param string $apiToken
     *
     * @return $this
     */
    public function withApiToken(string $apiToken);

    /**
     * @param string $validationToken
     *
     * @return $this
     */
    public function withValidationToken(string $validationToken);

    /**
     * @return User
     */
    public function build();
}

<?php

/*
 * This file is part of the CyclePath project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Builders;

use App\Models\User;
use App\Builders\Interfaces\UserBuilderInterface;

/**
 * Class UserBuilder
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserBuilder implements UserBuilderInterface
{
    /**
     * @var User
     */
    private $user;

    /**
     * @return $this
     */
    public function create()
    {
        $this->user = new User();

        return $this;
    }

    /**
     * @param string $firstname
     *
     * @return $this
     */
    public function withFirstname(string $firstname)
    {
        $this->user->setFirstname($firstname);

        return $this;
    }

    /**
     * @param string $lastname
     *
     * @return $this
     */
    public function withLastname(string $lastname)
    {
        $this->user->setLastname($lastname);

        return $this;
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function withUsername(string $username)
    {
        $this->user->setUsername($username);

        return $this;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function withEmail(string $email)
    {
        $this->user->setEmail($email);

        return $this;
    }

    /**
     * @param string $plainPassword
     *
     * @return $this
     */
    public function withPlainPassword(string $plainPassword)
    {
        $this->user->setPlainPassword($plainPassword);

        return $this;
    }

    /**
     * @param string $password
     *
     * @return $this
     */
    public function withPassword(string $password)
    {
        $this->user->setPassword($password);

        return $this;
    }

    /**
     * @param string $role
     *
     * @return $this
     */
    public function withRoles(string $role)
    {
        $this->user->addRole($role);

        return $this;
    }

    /**
     * @param \DateTime $creationDate
     *
     * @return $this
     */
    public function withCreationDate(\DateTime $creationDate)
    {
        $this->user->setCreationDate($creationDate);

        return $this;
    }

    /**
     * @param \DateTime $validationDate
     *
     * @return $this
     */
    public function withValidationDate(\DateTime $validationDate)
    {
        $this->user->setValidationDate($validationDate);

        return $this;
    }

    /**
     * @param bool $validated
     *
     * @return $this
     */
    public function withValidated(bool $validated)
    {
        $this->user->setValidated($validated);

        return $this;
    }

    /**
     * @param bool $active
     *
     * @return $this
     */
    public function withActive(bool $active)
    {
        $this->user->setActive($active);

        return $this;
    }

    /**
     * @param string $apiToken
     *
     * @return $this
     */
    public function withApiToken(string $apiToken)
    {
        $this->user->setApiToken($apiToken);

        return $this;
    }

    /**
     * @return User
     */
    public function build()
    {
        return $this->user;
    }
}

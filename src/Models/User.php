<?php

/*
 * This file is part of the CyclePath project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Models;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Class User
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @var string
     */
    private $password;

    /**
     * @var array
     */
    private $roles;

    /**
     * @var \DateTime
     */
    private $creationDate;

    /**
     * @var \DateTime
     */
    private $validationDate;

    /**
     * @var bool
     */
    private $validated;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var string
     */
    private $apiToken;

    /**
     * @var Image
     */
    private $image;

    /**
     * @var Collection
     */
    private $paths;

    /**
     * @var Collection
     */
    private $badges;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->creationDate = new \DateTime();

        $this->paths = new ArrayCollection();
        $this->badges = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId():? int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstname():? string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname():? string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPlainPassword():? string
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword(string $plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param string $role
     */
    public function addRole(string $role)
    {
        $this->roles[] = $role;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    /**
     * @return \DateTime
     */
    public function getValidationDate():? \DateTime
    {
        return $this->validationDate;
    }

    /**
     * @param \DateTime $validationDate
     */
    public function setValidationDate(\DateTime $validationDate)
    {
        $this->validationDate = $validationDate;
    }

    /**
     * @return bool
     */
    public function getValidated(): bool
    {
        return $this->validated;
    }

    /**
     * @param bool $validated
     */
    public function setValidated(bool $validated)
    {
        $this->validated = $validated;
    }

    /**
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active)
    {
        $this->active = $active;
    }

    /**
     * @return string
     */
    public function getApiToken():? string
    {
        return $this->apiToken;
    }

    /**
     * @param string $apiToken
     */
    public function setApiToken(string $apiToken)
    {
        $this->apiToken = $apiToken;
    }

    /**
     * @return Image
     */
    public function getImage():? Image
    {
        return $this->image;
    }

    /**
     * @param Image $image
     */
    public function setImage(Image $image)
    {
        $this->image = $image;
    }

    /**
     * @return Collection
     */
    public function getPaths():? Collection
    {
        return $this->paths;
    }

    /**
     * @param Path $paths
     */
    public function addPath(Path $paths)
    {
        $this->paths[] = $paths;
    }

    /**
     * @return Collection
     */
    public function getBadges():? Collection
    {
        return $this->badges;
    }

    /**
     * @param Badge $badges
     */
    public function addBadge(Badge $badges)
    {
        $this->badges[] = $badges;
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
    public function eraseCredentials() {}

    /**
     * @codeCoverageIgnore
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
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password
        ) = unserialize($serialized);
    }
}

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

namespace App\Models;

use App\Models\Interfaces\PathInterface;
use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\BadgeInterface;
use App\Models\Interfaces\ImageInterface;

/**
 * Class User
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
abstract class User implements UserInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $firstname;

    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $plainPassword;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var array
     */
    protected $roles;

    /**
     * @var \DateTime
     */
    protected $creationDate;

    /**
     * @var \DateTime
     */
    protected $validationDate;

    /**
     * @var bool
     */
    protected $validated;

    /**
     * @var bool
     */
    protected $active;

    /**
     * @var string
     */
    protected $apiToken;

    /**
     * @var string
     */
    protected $validationToken;

    /**
     * @var string
     */
    protected $resetToken;

    /**
     * @var Image
     */
    protected $image;

    /**
     * @var \ArrayAccess
     */
    protected $paths;

    /**
     * @var \ArrayAccess
     */
    protected $badges;

    /**
     * {@inheritdoc}
     */
    public function getId():? int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstname():? string
    {
        return $this->firstname;
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastname():? string
    {
        return $this->lastname;
    }

    /**
     * {@inheritdoc}
     */
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername():? string
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail():? string
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * {@inheritdoc}
     */
    public function getPlainPassword():? string
    {
        return $this->plainPassword;
    }

    /**
     * {@inheritdoc}
     */
    public function setPlainPassword(string $plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword():? string
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * {@inheritdoc}
     */
    public function addRole(string $role)
    {
        $this->roles[] = $role;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreationDate(): string
    {
        return $this->creationDate->format('d-m-Y h:i:s');
    }

    /**
     * {@inheritdoc}
     */
    public function setCreationDate(\DateTime $creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getValidationDate():? string
    {
        return $this->validationDate->format('d-m-Y h:i:s');
    }

    /**
     * {@inheritdoc}
     */
    public function setValidationDate(\DateTime $validationDate)
    {
        $this->validationDate = $validationDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getValidated(): bool
    {
        return $this->validated;
    }

    /**
     * {@inheritdoc}
     */
    public function setValidated(bool $validated)
    {
        $this->validated = $validated;
    }

    /**
     * {@inheritdoc}
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * {@inheritdoc}
     */
    public function setActive(bool $active)
    {
        $this->active = $active;
    }

    /**
     * {@inheritdoc}
     */
    public function getApiToken():? string
    {
        return $this->apiToken;
    }

    /**
     * {@inheritdoc}
     */
    public function setApiToken(string $apiToken)
    {
        $this->apiToken = $apiToken;
    }

    /**
     * {@inheritdoc}
     */
    public function getValidationToken(): string
    {
        return $this->validationToken;
    }

    /**
     * {@inheritdoc}
     */
    public function setValidationToken(string $validationToken)
    {
        $this->validationToken = $validationToken;
    }

    /**
     * {@inheritdoc}
     */
    public function getResetToken():? string
    {
        return $this->resetToken;
    }

    /**
     * {@inheritdoc}
     */
    public function setResetToken(string $resetToken)
    {
        $this->resetToken = $resetToken;
    }

    /**
     * {@inheritdoc}
     */
    public function getImage():? ImageInterface
    {
        return $this->image;
    }

    /**
     * {@inheritdoc}
     */
    public function setImage(ImageInterface $image)
    {
        $this->image = $image;
    }

    /**
     * {@inheritdoc}
     */
    public function getPaths():? \ArrayAccess
    {
        return $this->paths;
    }

    /**
     * {@inheritdoc}
     */
    public function addPath(PathInterface $paths)
    {
        $this->paths[] = $paths;
    }

    /**
     * {@inheritdoc}
     */
    public function removePath(PathInterface $path)
    {
        unset($this->paths[array_search($path, (array) $this->paths, true)]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBadges():? \ArrayAccess
    {
        return $this->badges;
    }

    /**
     * {@inheritdoc}
     */
    public function addBadge(BadgeInterface $badge)
    {
        $this->badges[] = $badge;
    }

    /**
     * {@inheritdoc}
     */
    public function removeBadge(BadgeInterface $badge)
    {
        unset($this->badges[array_search($badge, (array) $this->badges, true)]);
    }
}

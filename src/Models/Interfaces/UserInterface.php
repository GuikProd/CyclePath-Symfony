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

namespace App\Models\Interfaces;

/**
 * Interface UserInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface UserInterface extends \Serializable
{
    /**
     * @return int|null
     */
    public function getId():? int;

    /**
     * @return null|string
     */
    public function getFirstname():? string;

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname);

    /**
     * @return null|string
     */
    public function getLastname():? string;

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname);

    /**
     * @return null|string
     */
    public function getUsername():? string;

    /**
     * @param string $username
     */
    public function setUsername(string $username);

    /**
     * @return null|string
     */
    public function getEmail(): string;

    /**
     * @param string $email
     */
    public function setEmail(string $email);

    /**
     * @return null|string
     */
    public function getPlainPassword():? string;

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword(string $plainPassword);

    /**
     * @return null|string
     */
    public function getPassword(): string;

    /**
     * @param string $password
     */
    public function setPassword(string $password);

    /**
     * @param string $role
     */
    public function addRole(string $role);

    /**
     * @return array
     */
    public function getRoles(): array;

    /**
     * @return string
     */
    public function getCreationDate(): string;

    /**
     * @param \DateTime $creationDate
     */
    public function setCreationDate(\DateTime $creationDate);

    /**
     * @return null|string
     */
    public function getValidationDate():? string;

    /**
     * @param \DateTime $validationDate
     */
    public function setValidationDate(\DateTime $validationDate);

    /**
     * @return bool
     */
    public function getValidated(): bool;

    /**
     * @param bool $validated
     */
    public function setValidated(bool $validated);

    /**
     * @return bool
     */
    public function getActive(): bool ;

    /**
     * @param bool $active
     */
    public function setActive(bool $active);

    /**
     * @return null|string
     */
    public function getApiToken():? string;

    /**
     * @param string $apiToken
     */
    public function setApiToken(string $apiToken);

    /**
     * @return string
     */
    public function getValidationToken(): string;

    /**
     * @param string $validationToken
     */
    public function setValidationToken(string $validationToken);

    /**
     * @return null|string
     */
    public function getResetToken():? string;

    /**
     * @param string $resetToken
     */
    public function setResetToken(string $resetToken);

    /**
     * @return ImageInterface|null
     */
    public function getImage():? ImageInterface;

    /**
     * @param ImageInterface $image
     */
    public function setImage(ImageInterface $image);

    /**
     * @return \ArrayAccess|null
     */
    public function getPaths():? \ArrayAccess;

    /**
     * @param PathInterface $path
     */
    public function addPath(PathInterface $path);

    /**
     * @param PathInterface $path
     */
    public function removePath(PathInterface $path);

    /**
     * @return \ArrayAccess|null
     */
    public function getBadges():? \ArrayAccess;

    /**
     * @param BadgeInterface $badge
     */
    public function addBadge(BadgeInterface $badge);

    /**
     * @param BadgeInterface $badge
     */
    public function removeBadge(BadgeInterface $badge);
}

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
    public function getUsername(): string;

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
     * @return ImageInterface|null
     */
    public function getImage():? ImageInterface;

    /**
     * @param ImageInterface $image
     */
    public function setImage(ImageInterface $image);
}

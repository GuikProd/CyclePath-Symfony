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

/**
 * Class Image
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class Image
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $alt;

    /**
     * @var string
     */
    private $url;

    /**
     * @var \DateTime
     */
    private $creationDate;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Badge
     */
    private $badge;

    /**
     * Image constructor.
     */
    public function __construct()
    {
        $this->creationDate = new \DateTime();
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
    public function getAlt(): string
    {
        return $this->alt;
    }

    /**
     * @param string $alt
     */
    public function setAlt(string $alt)
    {
        $this->alt = $alt;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * This method is ignored because of the __construct() instantiation.
     *
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function getCreationDate(): string
    {
        return $this->creationDate->format('d-m-Y h:i:s');
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return Badge
     */
    public function getBadge():? Badge
    {
        return $this->badge;
    }

    /**
     * @param Badge $badge
     */
    public function setBadge(Badge $badge)
    {
        $this->badge = $badge;
    }
}

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

use App\Models\Interfaces\ImageInterface;

/**
 * Class Image
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class Image implements ImageInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $label;

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
     * @var Location
     */
    private $location;

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
    public function getLabel():? string
    {
        return $this->label;
    }

    /**
     * {@inheritdoc}
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    /**
     * {@inheritdoc}
     */
    public function getAlt(): string
    {
        return $this->alt;
    }

    /**
     * {@inheritdoc}
     */
    public function setAlt(string $alt)
    {
        $this->alt = $alt;
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * {@inheritdoc}
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
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

    /**
     * @return Location
     */
    public function getLocation():? Location
    {
        return $this->location;
    }

    /**
     * @param Location $location
     */
    public function setLocation(Location $location)
    {
        $this->location = $location;
    }
}

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

use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\BadgeInterface;
use App\Models\Interfaces\LocationInterface;

/**
 * Class Image.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
abstract class Image implements ImageInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $alt;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var \DateTime
     */
    protected $creationDate;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Badge
     */
    protected $badge;

    /**
     * @var Location
     */
    protected $location;

    /**
     * {@inheritdoc}
     */
    public function getId(): ? int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel(): ? string
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
     * {@inheritdoc}
     */
    public function getUser(): ? UserInterface
    {
        return $this->user;
    }

    /**
     * {@inheritdoc}
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * {@inheritdoc}
     */
    public function getBadge(): ? BadgeInterface
    {
        return $this->badge;
    }

    /**
     * {@inheritdoc}
     */
    public function setBadge(BadgeInterface $badge)
    {
        $this->badge = $badge;
    }

    /**
     * {@inheritdoc}
     */
    public function getLocation(): ? LocationInterface
    {
        return $this->location;
    }

    /**
     * {@inheritdoc}
     */
    public function setLocation(LocationInterface $location)
    {
        $this->location = $location;
    }
}

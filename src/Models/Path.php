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

/**
 * Class Path
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class Path
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $startingDate;

    /**
     * @var \DateTime
     */
    private $endingDate;

    /**
     * @var string
     */
    private $duration;

    /**
     * @var double
     */
    private $distance;

    /**
     * @var double
     */
    private $altitude;

    /**
     * @var bool
     */
    private $favorite;

    /**
     * @var Collection
     */
    private $locations;

    /**
     * @var User
     */
    private $user;

    /**
     * Path constructor.
     */
    public function __construct()
    {
        $this->startingDate = new \DateTime();

        $this->favorite = false;
    }

    /**
     * @return int
     */
    public function getId():? int
    {
        return $this->id;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \DateTime
     */
    public function getStartingDate(): \DateTime
    {
        return $this->startingDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndingDate():? \DateTime
    {
        return $this->endingDate;
    }

    /**
     * @param \DateTime $endingDate
     */
    public function setEndingDate(\DateTime $endingDate)
    {
        $this->endingDate = $endingDate;
    }

    /**
     * @return string
     */
    public function getDuration():? string
    {
        return $this->duration;
    }

    /**
     * @param string $duration
     */
    public function setDuration(string $duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return float
     */
    public function getDistance():? float
    {
        return $this->distance;
    }

    /**
     * @param float $distance
     */
    public function setDistance(float $distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return float
     */
    public function getAltitude():? float
    {
        return $this->altitude;
    }

    /**
     * @param float $altitude
     */
    public function setAltitude(float $altitude)
    {
        $this->altitude = $altitude;
    }

    /**
     * @return bool
     */
    public function getFavorite(): bool
    {
        return $this->favorite;
    }

    /**
     * @param bool $favorite
     */
    public function setFavorite(bool $favorite)
    {
        $this->favorite = $favorite;
    }

    /**
     * @return Collection
     */
    public function getLocations():? Collection
    {
        return $this->locations;
    }

    /**
     * @param Location $location
     *
     * @return Location
     */
    public function getLocation(Location $location)
    {
        return $this->locations->get($location);
    }

    /**
     * @param Location $location
     */
    public function addLocation(Location $location)
    {
        $this->locations[] = $location;
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
}

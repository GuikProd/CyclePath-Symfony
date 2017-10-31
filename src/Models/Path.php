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

use App\Models\Interfaces\PathInterface;
use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\LocationInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Path
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class Path implements PathInterface
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
     * @var UserInterface
     */
    private $user;

    /**
     * Path constructor.
     */
    public function __construct()
    {
        $this->locations = new ArrayCollection();
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
     * @return string
     */
    public function getStartingDate(): string
    {
        return $this->startingDate->format('d-m-Y h:i:s');
    }

    /**
     * {@inheritdoc}
     */
    public function setStartingDate(\DateTime $startingDate)
    {
        $this->startingDate = $startingDate;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function getEndingDate():? string
    {
        return $this->endingDate->format('d-m-Y h:i:s');
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
     * {@inheritdoc}
     */
    public function addLocation(LocationInterface $location)
    {
        $this->locations[] = $location;
    }

    /**
     * {@inheritdoc}
     */
    public function removeLocation(LocationInterface $location)
    {
        $this->locations->remove($location);
    }

    /**
     * {@inheritdoc}
     */
    public function getUser(): UserInterface
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
}

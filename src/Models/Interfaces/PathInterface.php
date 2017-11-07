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
 * Interface PathInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface PathInterface
{
    /**
     * @return int|null
     */
    public function getId():? int;

    /**
     * @return string
     */
    public function getStartingDate(): string;

    /**
     * @param \DateTime $startingDate
     */
    public function setStartingDate(\DateTime $startingDate);

    /**
     * @return null|string
     */
    public function getEndingDate():? string;

    /**
     * @param \DateTime $endingDate
     */
    public function setEndingDate(\DateTime $endingDate);

    /**
     * @return string
     */
    public function getDuration():? string;

    /**
     * @param string $duration
     */
    public function setDuration(string $duration);

    /**
     * @return float|null
     */
    public function getDistance():? float;

    /**
     * @param float $distance
     */
    public function setDistance(float $distance);

    /**
     * @return float|null
     */
    public function getAltitude():? float;

    /**
     * @param float $altitude
     */
    public function setAltitude(float $altitude);

    /**
     * @return bool
     */
    public function getFavorite(): bool;

    /**
     * @param bool $favorite
     */
    public function setFavorite(bool $favorite);

    /**
     * @return \ArrayAccess|null
     */
    public function getLocations():? \ArrayAccess;

    /**
     * @param LocationInterface $location
     */
    public function addLocation(LocationInterface $location);

    /**
     * @param LocationInterface $location
     */
    public function removeLocation(LocationInterface $location);

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface;

    /**
     * @param UserInterface $user
     */
    public function setUser(UserInterface $user);
}

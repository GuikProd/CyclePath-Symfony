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

namespace App\Builders\Interfaces;

use App\Models\Interfaces\PathInterface;
use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\LocationInterface;

/**
 * Interface PathBuilderInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface PathBuilderInterface
{
    /**
     * @return PathBuilderInterface
     */
    public function create(): PathBuilderInterface;

    /**
     * @param PathInterface $path
     *
     * @return PathBuilderInterface
     */
    public function setPath(PathInterface $path): PathBuilderInterface;

    /**
     * @param \DateTime $startingDate
     *
     * @return PathBuilderInterface
     */
    public function withStartingDate(\DateTime $startingDate): PathBuilderInterface;

    /**
     * @param \DateTime $endingDate
     *
     * @return PathBuilderInterface
     */
    public function withEndingDate(\DateTime $endingDate): PathBuilderInterface;

    /**
     * @param float $distance
     *
     * @return PathBuilderInterface
     */
    public function withDistance(float $distance): PathBuilderInterface;

    /**
     * @param string $duration
     *
     * @return PathBuilderInterface
     */
    public function withDuration(string $duration): PathBuilderInterface;

    /**
     * @param float $altitude
     *
     * @return PathBuilderInterface
     */
    public function withAltitude(float $altitude): PathBuilderInterface;

    /**
     * @param bool $favorite
     *
     * @return PathBuilderInterface
     */
    public function withFavorite(bool $favorite): PathBuilderInterface;

    /**
     * @param LocationInterface $location
     *
     * @return PathBuilderInterface
     */
    public function withLocation(LocationInterface $location): PathBuilderInterface;

    /**
     * @param UserInterface $user
     *
     * @return PathBuilderInterface
     */
    public function withUser(UserInterface $user): PathBuilderInterface;

    /**
     * @return PathInterface
     */
    public function build(): PathInterface;
}

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
use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\LocationInterface;

/**
 * Interface LocationBuilderInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface LocationBuilderInterface
{
    /**
     * @return LocationBuilderInterface
     */
    public function create(): LocationBuilderInterface;

    /**
     * @param LocationInterface $location
     *
     * @return LocationBuilderInterface
     */
    public function setLocation(LocationInterface $location): LocationBuilderInterface;

    /**
     * @param int $timestamp
     *
     * @return LocationBuilderInterface
     */
    public function withTimestamp(int $timestamp): LocationBuilderInterface;

    /**
     * @param float $latitude
     *
     * @return LocationBuilderInterface
     */
    public function withLatitude(float $latitude): LocationBuilderInterface;

    /**
     * @param float $longitude
     *
     * @return LocationBuilderInterface
     */
    public function withLongitude(float $longitude): LocationBuilderInterface;

    /**
     * @param PathInterface $path
     *
     * @return LocationBuilderInterface
     */
    public function withPath(PathInterface $path): LocationBuilderInterface;

    /**
     * @param ImageInterface $image
     *
     * @return LocationBuilderInterface
     */
    public function withImage(ImageInterface $image): LocationBuilderInterface;

    /**
     * @return LocationInterface
     */
    public function build(): LocationInterface;
}

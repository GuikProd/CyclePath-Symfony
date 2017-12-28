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
 * Interface LocationBuilderInterface.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface LocationBuilderInterface
{
    /**
     * @return LocationBuilderInterface
     */
    public function create(): self;

    /**
     * @param LocationInterface $location
     *
     * @return LocationBuilderInterface
     */
    public function setLocation(LocationInterface $location): self;

    /**
     * @param int $timestamp
     *
     * @return LocationBuilderInterface
     */
    public function withTimestamp(int $timestamp): self;

    /**
     * @param float $latitude
     *
     * @return LocationBuilderInterface
     */
    public function withLatitude(float $latitude): self;

    /**
     * @param float $longitude
     *
     * @return LocationBuilderInterface
     */
    public function withLongitude(float $longitude): self;

    /**
     * @param float $altitude
     *
     * @return LocationBuilderInterface
     */
    public function withAltitude(float $altitude): self;

    /**
     * @param PathInterface $path
     *
     * @return LocationBuilderInterface
     */
    public function withPath(PathInterface $path): self;

    /**
     * @param ImageInterface $image
     *
     * @return LocationBuilderInterface
     */
    public function withImage(ImageInterface $image): self;

    /**
     * @return LocationInterface
     */
    public function build(): LocationInterface;
}

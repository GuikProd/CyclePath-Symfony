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
 * Interface LocationInterface.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface LocationInterface
{
    /**
     * @return int|null
     */
    public function getId(): ? int;

    /**
     * @return int
     */
    public function getTimestamp(): int;

    /**
     * @param int $timestamp
     */
    public function setTimestamp(int $timestamp);

    /**
     * @return float
     */
    public function getLatitude(): float;

    /**
     * @param float $latitude
     */
    public function setLatitude(float $latitude);

    /**
     * @return float
     */
    public function getLongitude(): float;

    /**
     * @param float $longitude
     */
    public function setLongitude(float $longitude);

    /**
     * @return float|null
     */
    public function getAltitude(): ? float;

    /**
     * @param float $altitude
     */
    public function setAltitude(float $altitude);

    /**
     * @return PathInterface
     */
    public function getPath(): PathInterface;

    /**
     * @param PathInterface $path
     */
    public function setPath(PathInterface $path);

    /**
     * @return \ArrayAccess
     */
    public function getImages(): \ArrayAccess;

    /**
     * @param ImageInterface $image
     */
    public function addImage(ImageInterface $image);

    /**
     * @param ImageInterface $image
     */
    public function removeImage(ImageInterface $image);
}

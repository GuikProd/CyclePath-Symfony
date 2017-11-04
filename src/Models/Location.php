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

use App\Models\Interfaces\PathInterface;
use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\LocationInterface;

/**
 * Class Location
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
abstract class Location implements LocationInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $timestamp;

    /**
     * @var double
     */
    protected $latitude;

    /**
     * @var double
     */
    protected $longitude;

    /**
     * @var Path
     */
    protected $path;

    /**
     * @var \ArrayAccess
     */
    protected $images;

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
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * {@inheritdoc}
     */
    public function setTimestamp(int $timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * {@inheritdoc}
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * {@inheritdoc}
     */
    public function setLatitude(float $latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * {@inheritdoc}
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * {@inheritdoc}
     */
    public function setLongitude(float $longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * {@inheritdoc}
     */
    public function getPath(): PathInterface
    {
        return $this->path;
    }

    /**
     * {@inheritdoc}
     */
    public function setPath(PathInterface $path)
    {
        $this->path = $path;
    }

    /**
     * {@inheritdoc}
     */
    public function getImages():? \ArrayAccess
    {
        return $this->images;
    }

    /**
     * {@inheritdoc}
     */
    public function addImage(ImageInterface $image)
    {
        $this->images[] = $image;
    }

    /**
     * {@inheritdoc}
     */
    public function removeImage(ImageInterface $image)
    {
        unset($this->images[array_search($image, $this->images, true)]);
    }
}

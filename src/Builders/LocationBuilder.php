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

namespace App\Builders;

use App\Interactors\LocationInteractor;
use App\Models\Interfaces\PathInterface;
use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\LocationInterface;
use App\Builders\Interfaces\LocationBuilderInterface;

/**
 * Class LocationBuilder
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class LocationBuilder implements LocationBuilderInterface
{
    /**
     * @var LocationInterface
     */
    private $location;

    /**
     * {@inheritdoc}
     */
    public function create(): LocationBuilderInterface
    {
        $this->location = new LocationInteractor();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setLocation(LocationInterface $location): LocationBuilderInterface
    {
        $this->location = $location;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withTimestamp(int $timestamp): LocationBuilderInterface
    {
        $this->location->setTimestamp($timestamp);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withLatitude(float $latitude): LocationBuilderInterface
    {
        $this->location->setLatitude($latitude);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withLongitude(float $longitude): LocationBuilderInterface
    {
        $this->location->setLongitude($longitude);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withPath(PathInterface $path): LocationBuilderInterface
    {
        $this->location->setPath($path);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withImage(ImageInterface $image): LocationBuilderInterface
    {
        $this->location->addImage($image);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): LocationInterface
    {
        return $this->location;
    }
}

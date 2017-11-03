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

use App\Interactors\PathInteractor;
use App\Models\Interfaces\PathInterface;
use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\LocationInterface;
use App\Builders\Interfaces\PathBuilderInterface;

/**
 * Class PathBuilder
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class PathBuilder implements PathBuilderInterface
{
    /**
     * @var PathInteractor
     */
    private $path;

    /**
     * {@inheritdoc}
     */
    public function create()
    {
        $this->path = new PathInteractor();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setPath(PathInterface $path): PathBuilderInterface
    {
        $this->path = $path;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withStartingDate(\DateTime $startingDate): PathBuilderInterface
    {
        $this->path->setStartingDate($startingDate);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withEndingDate(\DateTime $endingDate): PathBuilderInterface
    {
        $this->path->setEndingDate($endingDate);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withDistance(float $distance): PathBuilderInterface
    {
        $this->path->setDistance($distance);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withDuration(string $duration): PathBuilderInterface
    {
        $this->path->setDuration($duration);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withAltitude(float $altitude): PathBuilderInterface
    {
        $this->path->setAltitude($altitude);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withFavorite(bool $favorite): PathBuilderInterface
    {
        $this->path->setFavorite($favorite);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withLocation(LocationInterface $location): PathBuilderInterface
    {
        $this->path->addLocation($location);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withUser(UserInterface $user): PathBuilderInterface
    {
        $this->path->setUser($user);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): PathInterface
    {
        return $this->path;
    }
}

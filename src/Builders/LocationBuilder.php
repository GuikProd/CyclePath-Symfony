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
    public function build(): LocationInterface
    {
        return $this->location;
    }
}

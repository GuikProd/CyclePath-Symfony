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
     * @return LocationInterface
     */
    public function build(): LocationInterface;
}

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

namespace App\Resolvers\Interfaces;

use App\Models\Interfaces\LocationInterface;

/**
 * Interface LocationResolverInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface LocationResolverInterface
{
    /**
     * @param \ArrayAccess $arguments        The arguments required to fetch Locations.
     *
     * @return LocationInterface[]|array     The Locations found using the arguments.
     */
    public function getLocations(\ArrayAccess $arguments);
}

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
 * Interface PathResolverInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface PathResolverInterface
{
    /**
     * @param \ArrayAccess $arguments        The arguments required to fetch Paths.
     *
     * @return LocationInterface[]|array     The Paths found using the arguments.
     */
    public function getPaths(\ArrayAccess $arguments);
}

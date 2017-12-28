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

namespace App\Mutators\Interfaces;

/**
 * Interface LocationMutatorInterface.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface LocationMutatorInterface
{
    /**
     * @param \ArrayAccess $arguments
     *
     * @return array
     */
    public function addLocation(\ArrayAccess $arguments): array;

    /**
     * @param \ArrayAccess $arguments
     *
     * @return array
     */
    public function removeLocations(\ArrayAccess $arguments): array;
}

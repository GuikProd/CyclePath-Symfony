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
 * Interface PathMutatorInterface.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface PathMutatorInterface
{
    /**
     * @param \ArrayAccess $arguments the arguments required to create a new Path
     *
     * @return array the Path created
     */
    public function createPath(\ArrayAccess $arguments): array;

    /**
     * @param \ArrayAccess $arguments the arguments required to update a Path
     *
     * @return array the Path updated
     */
    public function updatePath(\ArrayAccess $arguments): array;

    /**
     * @param \ArrayAccess $arguments the identifier required to delete the Path
     *
     * @return array the Path deleted
     */
    public function removePath(\ArrayAccess $arguments): array;
}

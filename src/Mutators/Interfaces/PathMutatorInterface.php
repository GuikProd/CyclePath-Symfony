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

use App\Models\Path;

/**
 * Interface PathMutatorInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface PathMutatorInterface
{
    /**
     * @param \ArrayAccess $arguments    The arguments required to create a new Path.
     *
     * @return Path                      The Path created.
     */
    public function createPath(\ArrayAccess $arguments);

    /**
     * @param \ArrayAccess $arguments    The identifier required by the deletion.
     *
     * @return Path                      The Path deleted.
     */
    public function removePath(\ArrayAccess $arguments);
}

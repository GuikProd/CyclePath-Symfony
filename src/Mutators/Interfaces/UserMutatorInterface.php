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

use App\Models\User;

/**
 * Interface UserMutatorInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface UserMutatorInterface
{
    /**
     * @param \ArrayAccess $arguments    The arguments needed for the update.
     *
     * @return User                      The User updated.
     */
    public function updateUser(\ArrayAccess $arguments);

    /**
     * @param \ArrayAccess $arguments    The arguments needed for the deletion.
     *
     * @return User                      The User deleted.
     */
    public function removeUser(\ArrayAccess $arguments);
}

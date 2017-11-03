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

use App\Models\Interfaces\UserInterface;

/**
 * Interface UserResolverInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface UserResolverInterface
{
    /**
     * @param \ArrayAccess $arguments    The arguments required to fetch Users.
     *
     * @return UserInterface[]|array     The users found using the arguments.
     */
    public function getUsers(\ArrayAccess $arguments);
}

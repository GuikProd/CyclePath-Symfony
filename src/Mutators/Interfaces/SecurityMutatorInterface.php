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
 * Interface SecurityMutatorInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface SecurityMutatorInterface
{
    /**
     * @param \ArrayAccess $arguments    The arguments received via the request.
     *
     * @return User                      The User who's been registered.
     */
    public function register(\ArrayAccess $arguments);

    /**
     * @param \ArrayAccess $arguments    The arguments needed to validate the account.
     *
     * @return User                      The User validated and active.
     */
    public function validate(\ArrayAccess $arguments);

    /**
     * @param \ArrayAccess $arguments    The arguments received via the request.
     *
     * @return User                      The User with the login credentials.
     */
    public function login(\ArrayAccess $arguments);

    /**
     * @param \ArrayAccess $arguments    The credentials needed for resetting the password.
     *
     * @return User                      The User with the reset credentials.
     */
    public function forgotPassword(\ArrayAccess $arguments);

    /**
     * @param \ArrayAccess $arguments    The credentials needed for achieving the reset.
     *
     * @return User                      The User with the new credentials.
     */
    public function resetPassword(\ArrayAccess $arguments);
}

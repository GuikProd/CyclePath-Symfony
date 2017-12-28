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

namespace App\Gateway\Interfaces;

use App\Models\User;

/**
 * Interface UserGatewayInterface.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface UserGatewayInterface
{
    /**
     * @param int $uuid the User unique identifier
     *
     * @return array the User linked to this identifier
     */
    public function getUserById(int $uuid);

    /**
     * @param int $uuid the User unique identifier
     *
     * @return User the User linked to this identifier along with linked Image
     */
    public function getUserWithImage(int $uuid);

    /**
     * @param int $uuid the User unique identifier
     *
     * @return User the User linked to this identifier along with linked Paths
     */
    public function getUserWithPaths(int $uuid);

    /**
     * @param int $uuid the User unique identifier
     *
     * @return User the User linked to this identifier along with linked Badges
     */
    public function getUserWithBadges(int $uuid);
}

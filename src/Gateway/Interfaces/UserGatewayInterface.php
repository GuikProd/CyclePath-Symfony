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

use App\Interactors\UserInteractor;

/**
 * Interface UserGatewayInterface.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface UserGatewayInterface
{
    /**
     * @param int $uuid               The unique identifier of the User.
     *
     * @return UserInteractor|null    The User if exist.
     */
    public function getUserById(int $uuid):? UserInteractor;

    /**
     * @param string $username        The username of the User.
     *
     * @return UserInteractor|null    The User if exist.
     */
    public function getUserByUsername(string $username):? UserInteractor;

    /**
     * @param string $email           The email of the User.
     *
     * @return UserInteractor|null    The User if exist.
     */
    public function getUserByEmail(string $email):? UserInteractor;

    /**
     * @param int $uuid          The User unique identifier
     *
     * @return UserInteractor    The User linked to this identifier along with linked Image
     */
    public function getUserWithImage(int $uuid);

    /**
     * @param int $uuid          The User unique identifier
     *
     * @return UserInteractor    The User linked to this identifier along with linked Paths
     */
    public function getUserWithPaths(int $uuid);

    /**
     * @param int $uuid          The User unique identifier
     *
     * @return UserInteractor    The User linked to this identifier along with linked Badges
     */
    public function getUserWithBadges(int $uuid);
}

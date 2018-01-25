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

namespace App\Repository\Interfaces;

use App\Interactors\UserInteractor;

/**
 * Interface UserGatewayInterface.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface UserGatewayInterface
{
    /**
     * @return array all the users found
     */
    public function getUsers(): array;

    /**
     * @param int $uuid the unique identifier of the User
     *
     * @return UserInteractor|null the User if exist
     */
    public function getUserById(int $uuid): ? UserInteractor;

    /**
     * @param string $username the username of the User
     *
     * @return UserInteractor|null the User if exist
     */
    public function getUserByUsername(string $username): ? UserInteractor;

    /**
     * @param string $email the email of the User
     *
     * @return UserInteractor|null the User if exist
     */
    public function getUserByEmail(string $email): ? UserInteractor;

    /**
     * @param string $username
     * @param string $email
     *
     * @return UserInteractor|null
     */
    public function getUserByUsernameAndEmail(string $username, string $email): ? UserInteractor;

    /**
     * @param int $uuid The User unique identifier
     *
     * @return UserInteractor The User linked to this identifier along with linked Image
     */
    public function getUserWithImage(int $uuid);

    /**
     * @param int $uuid The User unique identifier
     *
     * @return UserInteractor The User linked to this identifier along with linked Paths
     */
    public function getUserWithPaths(int $uuid);

    /**
     * @param int $uuid The User unique identifier
     *
     * @return UserInteractor The User linked to this identifier along with linked Badges
     */
    public function getUserWithBadges(int $uuid);
}

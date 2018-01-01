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

/**
 * Interface PathGatewayInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface PathGatewayInterface
{
    /**
     * @param int $uuid    The unique identifier of the User.
     *
     * @return array       The Paths linked to this User.
     */
    public function getUserPaths(int $uuid): array;
}

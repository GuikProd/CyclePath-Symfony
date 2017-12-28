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

namespace App\Events\Interfaces;

use App\Models\Interfaces\UserInterface;

/**
 * Interface UserEventInterface.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface UserEventInterface
{
    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface;
}

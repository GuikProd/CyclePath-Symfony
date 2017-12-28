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

namespace App\Managers\Interfaces;

use App\Models\Interfaces\UserInterface;

/**
 * Interface UserManagerInterface.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface UserManagerInterface
{
    /**
     * @param UserInterface $user the user to save
     */
    public function save(UserInterface $user): void;

    /**
     * @param UserInterface $user the user to update
     */
    public function update(UserInterface $user): void;

    /**
     * @param UserInterface $user the user to delete
     */
    public function delete(UserInterface $user): void;
}

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

use App\Models\Interfaces\BadgeInterface;

/**
 * Interface BadgeMutatorInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface BadgeMutatorInterface
{
    /**
     * @param array $arguments    The array of arguments passed via the request.
     *
     * @return BadgeInterface     The Badge created.
     */
    public function createBadge(array $arguments);

    /**
     * @param array $arguments    The array of arguments passed via the request.
     *
     * @return BadgeInterface     The Badge updated.
     */
    public function updateBadge(array $arguments);

    /**
     * @param array $arguments    The array of arguments passed via the request.
     *
     * @return BadgeInterface     The Badge who's been deleted.
     */
    public function removeBadge(array $arguments);
}

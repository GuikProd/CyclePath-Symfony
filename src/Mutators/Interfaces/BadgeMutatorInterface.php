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
     * @param \ArrayAccess $arguments    The array of arguments passed via the request.
     *
     * @return BadgeInterface            The Badge created.
     */
    public function createBadge(\ArrayAccess $arguments);

    /**
     * @param \ArrayAccess $arguments    The array of arguments passed via the request.
     *
     * @return BadgeInterface            The Badge who's been updated.
     */
    public function updateBadge(\ArrayAccess $arguments);

    /**
     * @param \ArrayAccess $arguments    The array of arguments passed via the request.
     *
     * @return BadgeInterface            The Badge who's been removed.
     */
    public function removeBadge(\ArrayAccess $arguments);
}

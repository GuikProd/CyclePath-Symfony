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

use App\Models\Interfaces\BadgeInterface;

/**
 * Interface BadgeResolverInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface BadgeResolverInterface
{
    /**
     * @param \ArrayAccess $arguments    The array of arguments passed via the request.
     *
     * @return BadgeInterface[]          The Badges stored.
     */
    public function getBadges(\ArrayAccess $arguments);
}

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

namespace App\Interactors;

use App\Models\Location;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class LocationInteractor
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class LocationInteractor extends Location
{
    /**
     * LocationInteractor constructor.
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
    }
}

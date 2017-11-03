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

namespace App\Builders\Interfaces;

use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\BadgeInterface;
use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\LocationInterface;

/**
 * Interface ImageBuilderInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface ImageBuilderInterface
{
    /**
     * @return $this
     */
    public function create();

    /**
     * @param string $label
     *
     * @return $this
     */
    public function withLabel(string $label);

    /**
     * @param string $alt
     *
     * @return $this
     */
    public function withAlt(string $alt);

    /**
     * @param string $url
     *
     * @return $this
     */
    public function withUrl(string $url);

    /**
     * @param \DateTime $creationDate
     *
     * @return $this
     */
    public function withCreationDate(\DateTime $creationDate);

    /**
     * @param UserInterface $user
     *
     * @return $this
     */
    public function withUser(UserInterface $user);

    /**
     * @param BadgeInterface $badge
     *
     * @return $this
     */
    public function withBadge(BadgeInterface $badge);

    /**
     * @param LocationInterface $location
     *
     * @return $this
     */
    public function withLocation(LocationInterface $location);

    /**
     * @return ImageInterface
     */
    public function build(): ImageInterface;
}

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

/**
 * Interface BadgeBuilderInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface BadgeBuilderInterface
{
    /**
     * @return $this
     */
    public function create();

    /**
     * @param BadgeInterface $badge
     *
     * @return BadgeBuilderInterface
     */
    public function setBadge(BadgeInterface $badge): BadgeBuilderInterface;

    /**
     * @param string $label
     *
     * @return BadgeBuilderInterface
     */
    public function withLabel(string $label): BadgeBuilderInterface;

    /**
     * @param \DateTime $obtentionDate
     *
     * @return BadgeBuilderInterface
     */
    public function withObtentionDate(\DateTime $obtentionDate): BadgeBuilderInterface;

    /**
     * @param int $level
     *
     * @return BadgeBuilderInterface
     */
    public function withLevel(int $level): BadgeBuilderInterface;

    /**
     * @param UserInterface $user
     *
     * @return BadgeBuilderInterface
     */
    public function withUser(UserInterface $user): BadgeBuilderInterface;

    /**
     * @param ImageInterface $image
     *
     * @return BadgeBuilderInterface
     */
    public function withImage(ImageInterface $image): BadgeBuilderInterface;

    /**
     * @return BadgeInterface
     */
    public function build(): BadgeInterface;
}

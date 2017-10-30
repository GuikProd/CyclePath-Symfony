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

use App\Models\Badge;
use App\Models\Image;
use App\Models\User;

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
     * @param string $label
     *
     * @return $this
     */
    public function withLabel(string $label);

    /**
     * @param \DateTime $obtentionDate
     *
     * @return $this
     */
    public function withObtentionDate(\DateTime $obtentionDate);

    /**
     * @param int $level
     *
     * @return $this
     */
    public function withLevel(int $level);

    /**
     * @param User $user
     *
     * @return $this
     */
    public function withUser(User $user);

    /**
     * @param Image $image
     *
     * @return $this
     */
    public function withImage(Image $image);

    /**
     * @return Badge
     */
    public function build();
}

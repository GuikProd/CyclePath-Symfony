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

namespace App\Models\Interfaces;

use App\Models\User;
use App\Models\Image;

/**
 * Interface BadgeInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface BadgeInterface
{
    /**
     * @return int|null
     */
    public function getId():? int;

    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @param string $label
     */
    public function setLabel(string $label);

    /**
     * @return string
     */
    public function getObtentionDate(): string;

    /**
     * @param \DateTime $obtentionDate
     */
    public function setObtentionDate(\DateTime $obtentionDate);

    /**
     * @return int
     */
    public function getLevel(): int;

    /**
     * @param int $level
     */
    public function setLevel(int $level);

    /**
     * @return User|null
     */
    public function getUser():? User;

    /**
     * @param User $user
     */
    public function setUser(User $user);

    /**
     * @return Image|null
     */
    public function getImage():? Image;

    /**
     * @param Image $image
     */
    public function setImage(Image $image);
}

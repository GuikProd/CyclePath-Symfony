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

/**
 * Interface BadgeInterface.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface BadgeInterface
{
    /**
     * @return int|null
     */
    public function getId(): ? int;

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
     * @return UserInterface|null
     */
    public function getUser(): ? UserInterface;

    /**
     * @param UserInterface $user
     */
    public function setUser(UserInterface $user);

    /**
     * @return ImageInterface|null
     */
    public function getImage(): ? ImageInterface;

    /**
     * @param ImageInterface $image
     */
    public function setImage(ImageInterface $image);
}

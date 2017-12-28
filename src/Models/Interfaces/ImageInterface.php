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
 * Interface ImageInterface.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface ImageInterface
{
    /**
     * @return int|null
     */
    public function getId(): ? int;

    /**
     * @return null|string
     */
    public function getLabel(): ? string;

    /**
     * @param string $label
     */
    public function setLabel(string $label);

    /**
     * @return string
     */
    public function getAlt(): string;

    /**
     * @param string $alt
     */
    public function setAlt(string $alt);

    /**
     * @return string
     */
    public function getUrl(): string;

    /**
     * @param string $url
     */
    public function setUrl(string $url);

    /**
     * @return string
     */
    public function getCreationDate(): string;

    /**
     * @param \DateTime $creationDate
     */
    public function setCreationDate(\DateTime $creationDate);

    /**
     * @return UserInterface|null
     */
    public function getUser(): ? UserInterface;

    /**
     * @param UserInterface $user
     */
    public function setUser(UserInterface $user);

    /**
     * @return BadgeInterface|null
     */
    public function getBadge(): ? BadgeInterface;

    /**
     * @param BadgeInterface $badge
     */
    public function setBadge(BadgeInterface $badge);

    /**
     * @return LocationInterface|null
     */
    public function getLocation(): ? LocationInterface;

    /**
     * @param LocationInterface $location
     */
    public function setLocation(LocationInterface $location);
}

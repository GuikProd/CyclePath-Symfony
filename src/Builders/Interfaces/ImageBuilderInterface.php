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
     * @return ImageBuilderInterface
     */
    public function create(): ImageBuilderInterface;

    /**
     * @param ImageInterface $image
     *
     * @return ImageBuilderInterface
     */
    public function setImage(ImageInterface $image): ImageBuilderInterface;

    /**
     * @param string $label
     *
     * @return ImageBuilderInterface
     */
    public function withLabel(string $label): ImageBuilderInterface;

    /**
     * @param string $alt
     *
     * @return ImageBuilderInterface
     */
    public function withAlt(string $alt): ImageBuilderInterface;

    /**
     * @param string $url
     *
     * @return ImageBuilderInterface
     */
    public function withUrl(string $url): ImageBuilderInterface;

    /**
     * @param \DateTime $creationDate
     *
     * @return ImageBuilderInterface
     */
    public function withCreationDate(\DateTime $creationDate): ImageBuilderInterface;

    /**
     * @param UserInterface $user
     *
     * @return ImageBuilderInterface
     */
    public function withUser(UserInterface $user): ImageBuilderInterface;

    /**
     * @param BadgeInterface $badge
     *
     * @return ImageBuilderInterface
     */
    public function withBadge(BadgeInterface $badge): ImageBuilderInterface;

    /**
     * @param LocationInterface $location
     *
     * @return ImageBuilderInterface
     */
    public function withLocation(LocationInterface $location): ImageBuilderInterface;

    /**
     * @return ImageInterface
     */
    public function build(): ImageInterface;
}

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

namespace App\Builders;

use App\Interactors\ImageInteractor;
use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\BadgeInterface;
use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\LocationInterface;
use App\Builders\Interfaces\ImageBuilderInterface;

/**
 * Class ImageBuilder
 *
 * @author Guillaume loulier <contact@guillaumeloulier.fr>
 */
final class ImageBuilder implements ImageBuilderInterface
{
    /**
     * @var ImageInterface
     */
    private $image;

    /**
     * {@inheritdoc}
     */
    public function create()
    {
        $this->image = new ImageInteractor();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setImage(ImageInterface $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withLabel(string $label)
    {
        $this->image->setLabel($label);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withAlt(string $alt)
    {
        $this->image->setAlt($alt);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withUrl(string $url)
    {
        $this->image->setUrl($url);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withCreationDate(\DateTime $creationDate)
    {
        $this->image->setCreationDate($creationDate);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withUser(UserInterface $user)
    {
        $this->image->setUser($user);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withBadge(BadgeInterface $badge)
    {
        $this->image->setBadge($badge);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withLocation(LocationInterface $location)
    {
        $this->image->setLocation($location);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): ImageInterface
    {
        return $this->image;
    }
}

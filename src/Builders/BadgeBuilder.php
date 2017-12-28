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

use App\Interactors\BadgeInteractor;
use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\BadgeInterface;
use App\Models\Interfaces\ImageInterface;
use App\Builders\Interfaces\BadgeBuilderInterface;

/**
 * Class BadgeBuilder.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class BadgeBuilder implements BadgeBuilderInterface
{
    /**
     * @var BadgeInterface
     */
    private $badge;

    /**
     * {@inheritdoc}
     */
    public function create()
    {
        $this->badge = new BadgeInteractor();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setBadge(BadgeInterface $badge): BadgeBuilderInterface
    {
        $this->badge = $badge;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withLabel(string $label): BadgeBuilderInterface
    {
        $this->badge->setLabel($label);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withObtentionDate(\DateTime $obtentionDate): BadgeBuilderInterface
    {
        $this->badge->setObtentionDate($obtentionDate);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withLevel(int $level): BadgeBuilderInterface
    {
        $this->badge->setLevel($level);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withUser(UserInterface $user): BadgeBuilderInterface
    {
        $this->badge->setUser($user);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withImage(ImageInterface $image): BadgeBuilderInterface
    {
        $this->badge->setImage($image);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): BadgeInterface
    {
        return $this->badge;
    }
}

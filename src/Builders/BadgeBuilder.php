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

use App\Models\User;
use App\Models\Badge;
use App\Models\Image;
use App\Builders\Interfaces\BadgeBuilderInterface;

/**
 * Class BadgeBuilder
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class BadgeBuilder implements BadgeBuilderInterface
{
    /**
     * @var Badge
     */
    private $badge;

    /**
     * {@inheritdoc}
     */
    public function create()
    {
        $this->badge = new Badge();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withLabel(string $label)
    {
        $this->badge->setLabel($label);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withObtentionDate(\DateTime $obtentionDate)
    {
        $this->badge->setObtentionDate($obtentionDate);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withLevel(int $level)
    {
        $this->badge->setLevel($level);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withUser(User $user)
    {
        $this->badge->setUser($user);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withImage(Image $image)
    {
        $this->badge->setImage($image);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return $this->badge;
    }
}

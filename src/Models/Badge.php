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

namespace App\Models;

use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\BadgeInterface;
use App\Models\Interfaces\ImageInterface;

/**
 * Class Badge
 *
 * @author guillaume Loulier <contact@guillaumeloulier.fr>
 */
class Badge implements BadgeInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $label;

    /**
     * @var \DateTime
     */
    private $obtentionDate;

    /**
     * @var int
     */
    private $level;

    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @var ImageInterface
     */
    private $image;

    /**
     * {@inheritdoc}
     */
    public function getId():? int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * {@inheritdoc}
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    /**
     * {@inheritdoc}
     */
    public function setObtentionDate(\DateTime $obtentionDate)
    {
        $this->obtentionDate = $obtentionDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getObtentionDate(): string
    {
        return $this->obtentionDate->format('d-m-Y h:i:s');
    }

    /**
     * {@inheritdoc}
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * {@inheritdoc}
     */
    public function setLevel(int $level)
    {
        $this->level = $level;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser():? UserInterface
    {
        return $this->user;
    }

    /**
     * {@inheritdoc}
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * {@inheritdoc}
     */
    public function getImage():? ImageInterface
    {
        return $this->image;
    }

    /**
     * {@inheritdoc}
     */
    public function setImage(ImageInterface $image)
    {
        $this->image = $image;
    }
}

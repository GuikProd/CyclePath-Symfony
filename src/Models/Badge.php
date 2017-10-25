<?php

/*
 * This file is part of the CyclePath project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Models;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Badge
 *
 * @author guillaume Loulier <contact@guillaumeloulier.fr>
 */
class Badge
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
     * @var Collection
     */
    private $users;

    /**
     * @var Image
     */
    private $image;

    /**
     * Badge constructor.
     */
    public function __construct()
    {
        $this->obtentionDate = new \Datetime();

        $this->users = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId():? int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function getObtentionDate(): string
    {
        return $this->obtentionDate->format('d-m-Y h:i:s');
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level)
    {
        $this->level = $level;
    }

    /**
     * @return Collection
     */
    public function getUsers():? Collection
    {
        return $this->users;
    }

    /**
     * @param User $user
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;
    }

    /**
     * @return Image
     */
    public function getImage():? Image
    {
        return $this->image;
    }

    /**
     * @param Image $image
     */
    public function setImage(Image $image)
    {
        $this->image = $image;
    }
}

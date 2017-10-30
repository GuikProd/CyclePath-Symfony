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

use App\Models\Path;
use App\Builders\Interfaces\PathBuilderInterface;

/**
 * Class PathBuilder
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class PathBuilder implements PathBuilderInterface
{
    /**
     * @var Path
     */
    private $path;

    /**
     * {@inheritdoc}
     */
    public function create()
    {
        $this->path = new Path();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): Path
    {
        return $this->path;
    }
}

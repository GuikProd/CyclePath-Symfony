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

namespace App\Resolvers;

use App\Interactors\PathInteractor;
use App\Models\Path;
use App\Models\Interfaces\PathInterface;
use App\Resolvers\Interfaces\PathResolverInterface;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Argument;

/**
 * Class PathResolver
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class PathResolver implements PathResolverInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * LocationResolver constructor.
     *
     * @param EntityManagerInterface $entityManagerInterface
     */
    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManagerInterface = $entityManagerInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function getPaths(\ArrayAccess $arguments)
    {
        if ($arguments->offsetExists('id')) {
            return [
                $this->entityManagerInterface
                     ->getRepository(PathInteractor::class)
                     ->findOneBy([
                         'id' => $arguments->offsetGet('id')
                     ])
            ];
        }

        return $this->entityManagerInterface
                    ->getRepository(PathInteractor::class)
                    ->findAll();
    }
}

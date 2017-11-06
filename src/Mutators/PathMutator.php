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

namespace App\Mutators;

use App\Interactors\PathInteractor;
use Doctrine\ORM\EntityManagerInterface;
use App\Builders\Interfaces\PathBuilderInterface;
use App\Mutators\Interfaces\PathMutatorInterface;

/**
 * Class PathMutator
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class PathMutator implements PathMutatorInterface
{
    /**
     * @var PathBuilderInterface
     */
    private $pathBuilderInterface;

    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * PathMutator constructor.
     *
     * @param PathBuilderInterface $pathBuilderInterface
     * @param EntityManagerInterface $entityManagerInterface
     */
    public function __construct(
        PathBuilderInterface $pathBuilderInterface,
        EntityManagerInterface $entityManagerInterface
    ) {
        $this->pathBuilderInterface = $pathBuilderInterface;
        $this->entityManagerInterface = $entityManagerInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function createPath(\ArrayAccess $arguments): array
    {
        $this->pathBuilderInterface
             ->create()
             ->withStartingDate($arguments->offsetGet('startingDate'))
             ->withEndingDate($arguments->offsetGet('endingDate'))
             ->withFavorite(false)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function updatePath(\ArrayAccess $arguments): array
    {
        // TODO: Implement updatePath() method.
    }

    /**
     * {@inheritdoc}
     */
    public function removePath(\ArrayAccess $arguments) :array
    {
        $path = $this->entityManagerInterface
                     ->getRepository(PathInteractor::class)
                     ->findOneBy([
                         'id' => $arguments->offsetGet('id')
                     ]);

        $this->entityManagerInterface->remove($path);
        $this->entityManagerInterface->flush();

        return [
            $this->entityManagerInterface
                 ->getRepository(PathInteractor::class)
                 ->findOneBy([
                     'id' => $arguments->offsetGet('id')
                 ])
        ];
    }
}

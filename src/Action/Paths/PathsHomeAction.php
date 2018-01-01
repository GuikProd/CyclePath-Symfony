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

namespace App\Action\Paths;

use App\Interactors\PathInteractor;
use Doctrine\ORM\EntityManagerInterface;
use App\Responder\Paths\PathsHomeResponder;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class PathsHomeAction.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class PathsHomeAction
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorageInterface;

    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * PathsHomeAction constructor.
     *
     * @param TokenStorageInterface $tokenStorageInterface
     * @param EntityManagerInterface $entityManagerInterface
     */
    public function __construct(
        TokenStorageInterface $tokenStorageInterface,
        EntityManagerInterface $entityManagerInterface
    ) {
        $this->tokenStorageInterface = $tokenStorageInterface;
        $this->entityManagerInterface = $entityManagerInterface;
    }

    /**
     * @param PathsHomeResponder $responder
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(PathsHomeResponder $responder)
    {
        if (!is_string($this->tokenStorageInterface->getToken()->getUser())) {
            $paths = $this->entityManagerInterface
                          ->getRepository(PathInteractor::class)
                          ->getUserPaths(
                              $this->tokenStorageInterface
                                   ->getToken()
                                   ->getUser()
                                   ->getId()
                          );

            return $responder($paths);
        }

        return $responder();
    }
}

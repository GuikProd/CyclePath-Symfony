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

namespace spec\App\Repository;

use PhpSpec\ObjectBehavior;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UserRepositorySpec
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserRepositorySpec extends ObjectBehavior
{
    /**
     * @param EntityManagerInterface|\PhpSpec\Wrapper\Collaborator $entityManager
     * @param ClassMetadata|\PhpSpec\Wrapper\Collaborator $classMetadata
     */
    public function it_is_initializable(EntityManagerInterface $entityManager, ClassMetadata $classMetadata)
    {
        $this->beConstructedWith($entityManager, $classMetadata);
    }
}

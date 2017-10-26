<?php

/*
 * This file is part of the CyclePath project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Resolvers;

use App\Models\User;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

/**
 * Class UserResolver
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserResolver implements ResolverInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * UserResolver constructor.
     *
     * @param EntityManagerInterface $entityManagerInterface
     */
    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManagerInterface = $entityManagerInterface;
    }

    /**
     * @param Argument $argument
     *
     * @return User[]|array
     */
    public function getUsers(Argument $argument)
    {
        if ($argument->offsetExists('id')) {
            return [
                $this->entityManagerInterface->getRepository(User::class)
                                             ->findOneBy([
                                                 'id' => $argument->offsetGet('id')
                                             ])
            ];
        }

        return $this->entityManagerInterface->getRepository(User::class)->findAll();
    }
}

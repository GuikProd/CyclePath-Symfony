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

use App\Resolvers\Interfaces\UserResolverInterface;
use App\Repository\Interfaces\UserGatewayInterface;

/**
 * Class UserResolver.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserResolver implements UserResolverInterface
{
    /**
     * @var UserGatewayInterface
     */
    private $userGatewayInterface;

    /**
     * UserResolver constructor.
     *
     * @param UserGatewayInterface $userGatewayInterface
     */
    public function __construct(UserGatewayInterface $userGatewayInterface)
    {
        $this->userGatewayInterface = $userGatewayInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsers(\ArrayAccess $arguments)
    {
        switch ($arguments) {
            case $arguments->offsetExists('id'):
                return [
                    $this->userGatewayInterface
                         ->getUserById((int) $arguments->offsetGet('id')),
                ];
                break;
            case $arguments->offsetExists('username'):
                return [
                    $this->userGatewayInterface
                         ->getUserByUsername((string) $arguments->offsetGet('username')),
                ];
                break;
            case $arguments->offsetExists('email'):
                return [
                    $this->userGatewayInterface
                         ->getUserByEmail((string) $arguments->offsetGet('email')),
                ];
                break;
            case $arguments->offsetExists('username') && $arguments->offsetExists('email'):
                return [
                    $this->userGatewayInterface
                         ->getUserByEmailAndUsername(
                             (string) $arguments->offsetGet('username'),
                             (string) $arguments->offsetGet('email')
                         )
                ];
                break;
            default:
                return $this->userGatewayInterface
                            ->getUsers();
                break;
        }
    }
}

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

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use App\Gateway\Interfaces\PathGatewayInterface;

/**
 * Class PathRepository.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class PathRepository extends EntityRepository implements PathGatewayInterface
{
    /**
     * {@inheritdoc}
     */
    public function getUserPaths(int $uuid): array
    {
        return $this->createQueryBuilder('paths')
                    ->where('paths.user = :user')
                    ->setParameter('user', $uuid)
                    ->setCacheable(true)
                    ->getQuery()
                    ->getArrayResult();
    }
}

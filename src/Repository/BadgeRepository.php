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
use App\Repository\Interfaces\BadgeGatewayInterface;

/**
 * Class BadgeRepository.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BadgeRepository extends EntityRepository implements BadgeGatewayInterface
{
}

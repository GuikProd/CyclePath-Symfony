<?php

/*
 * This file is part of the CyclePath project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Builders;

use App\Builders\UserBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Class UserBuilderTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserBuilderTest extends TestCase
{
    public function testInstantiation()
    {
        $builder = new UserBuilder();

        $builder->create()
                ->withFirstname('Harry')
                ->withLastname('Potter')
        ;

        static::assertNull($builder->build()->getId());
        static::assertEquals('Harry', $builder->build()->getFirstname());
        static::assertEquals('Potter', $builder->build()->getLastname());
    }
}

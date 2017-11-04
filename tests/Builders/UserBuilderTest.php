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

        $builder
            ->create()
            ->withFirstname('Harry')
            ->withLastname('Potter')
            ->withUsername('HP')
            ->withEmail('hp@gmail.com')
            ->withPlainPassword('Ie1FDLHHP')
            ->withPassword('Ie1FDLHHP')
            ->withRole('ROLE_USER')
            ->withCreationDate(new \DateTime('2017-04-15'))
            ->withValidationDate(new \DateTime('2017-04-23'))
            ->withValidated(true)
            ->withActive(true)
            ->withApiToken('2a9d91c6419da242a84v8brt4vza9c9caca14ca9')
            ->withValidationToken('2a9d91c6419da242a84v8brt4vza9c9caca14ca9')
            ->withResetToken('2a9d91c6419da242a84v8brt4vza9c9caca14ca9')
        ;

        static::assertNull($builder->build()->getId());
        static::assertEquals('Harry', $builder->build()->getFirstname());
        static::assertEquals('Potter', $builder->build()->getLastname());
    }

    public function testSetter()
    {

    }
}

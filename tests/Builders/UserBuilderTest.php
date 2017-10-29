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

use App\Models\User;
use App\Builders\UserBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Class UserBuilderTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserBuilderTest extends TestCase
{
    public function testReturn()
    {
        $userBuilder = new UserBuilder();
        $userBuilder->create();

        static::assertInstanceOf(
            User::class,
            $userBuilder->build()
        );
    }

    public function testModelCall()
    {
        $userBuilder = new UserBuilder();
        $userBuilder->create();

        $userBuilder->withFirstname('Harry');
        $userBuilder->withLastname('Potter');
        $userBuilder->withUsername('HP');
        $userBuilder->withEmail('hp@gmail.com');
        $userBuilder->withPlainPassword('Ie1FDLHHP');
        $userBuilder->withPassword('Ie1FDLHHP');
        $userBuilder->withRoles('ROLE_WIZARD');
        $userBuilder->withCreationDate(new \DateTime('2015-03-21'));
        $userBuilder->withValidationDate(new \Datetime('2017-04-24'));
        $userBuilder->withValidated(true);
        $userBuilder->withActive(false);
        $userBuilder->withApiToken('6a41d94d2a0d45a-41a5-d2ad4ad-d52a-d4ad');

        static::assertNull($userBuilder->build()->getId());
        static::assertEquals('Harry', $userBuilder->build()->getFirstname());
        static::assertEquals('Potter', $userBuilder->build()->getLastname());
        static::assertEquals('HP', $userBuilder->build()->getUsername());
        static::assertEquals('hp@gmail.com', $userBuilder->build()->getEmail());
        static::assertEquals('Ie1FDLHHP', $userBuilder->build()->getPlainPassword());
        static::assertEquals('Ie1FDLHHP', $userBuilder->build()->getPassword());
        static::assertContains('ROLE_WIZARD', $userBuilder->build()->getRoles());
        static::assertEquals("21-03-2015 12:00:00", $userBuilder->build()->getCreationDate());
        static::assertEquals("24-04-2017 12:00:00", $userBuilder->build()->getValidationDate());
        static::assertTrue($userBuilder->build()->getValidated());
        static::assertFalse($userBuilder->build()->getActive());
        static::assertEquals('6a41d94d2a0d45a-41a5-d2ad4ad-d52a-d4ad', $userBuilder->build()->getApiToken());
    }
}

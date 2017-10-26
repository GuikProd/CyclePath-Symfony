<?php

/*
 * This file is part of the CyclePath project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Models;

use App\Models\Badge;
use App\Models\Path;
use App\Models\User;
use App\Models\Image;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserTest extends TestCase
{
    public function testInstantiation()
    {
        $user = new User();
        
        $user->setFirstname('Harry');
        $user->setLastname('Potter');
        $user->setUsername('HP');
        $user->setEmail('hp@gmail.com');
        $user->setPlainPassword('Ie1FDLHHP');
        $user->setPassword('Ie1FDLHHP');
        $user->addRole('ROLE_WIZARD');
        $user->setValidationDate(new \Datetime('2017-04-24'));
        $user->setValidated(true);
        $user->setActive(false);
        $user->setApiToken('6a41d94d2a0d45a-41a5-d2ad4ad-d52a-d4ad');

        static::assertNull($user->getId());
        static::assertEquals('Harry', $user->getFirstname());
        static::assertEquals('Potter', $user->getLastname());
        static::assertEquals('HP', $user->getUsername());
        static::assertEquals('hp@gmail.com', $user->getEmail());
        static::assertEquals('Ie1FDLHHP', $user->getPlainPassword());
        static::assertEquals('Ie1FDLHHP', $user->getPassword());
        static::assertContains('ROLE_WIZARD', $user->getRoles());
        static::assertTrue($user->getValidated());
        static::assertFalse($user->getActive());
        static::assertEquals('6a41d94d2a0d45a-41a5-d2ad4ad-d52a-d4ad', $user->getApiToken());
    }

    public function testImageRelation()
    {
        $user = new User();

        $user->setFirstname('Harry');
        $user->setLastname('Potter');
        $user->setUsername('HP');
        $user->setEmail('hp@gmail.com');
        $user->setPlainPassword('Ie1FDLHHP');
        $user->setPassword('Ie1FDLHHP');
        $user->addRole('ROLE_WIZARD');
        $user->setValidationDate(new \Datetime('2017-04-24'));
        $user->setValidated(true);
        $user->setActive(false);
        $user->setApiToken('6a41d94d2a0d45a-41a5-d2ad4ad-d52a-d4ad');

        $image = $this->createMock(Image::class);
        $image->method('getId')
              ->willReturn(65);

        $user->setImage($image);

        static::assertEquals(65, $user->getImage()->getId());
    }

    public function testPathRelation()
    {
        $user = new User();

        $user->setFirstname('Harry');
        $user->setLastname('Potter');
        $user->setUsername('HP');
        $user->setEmail('hp@gmail.com');
        $user->setPlainPassword('Ie1FDLHHP');
        $user->setPassword('Ie1FDLHHP');
        $user->addRole('ROLE_WIZARD');
        $user->setValidationDate(new \Datetime('2017-04-24'));
        $user->setValidated(true);
        $user->setActive(false);
        $user->setApiToken('6a41d94d2a0d45a-41a5-d2ad4ad-d52a-d4ad');

        $path = $this->createMock(Path::class);
        $path->method('getId')
             ->willReturn(100);

        $user->addPath($path);

        static::assertContains($path, $user->getPaths());
    }

    public function testBadgeRelation()
    {
        $user = new User();

        $user->setFirstname('Harry');
        $user->setLastname('Potter');
        $user->setUsername('HP');
        $user->setEmail('hp@gmail.com');
        $user->setPlainPassword('Ie1FDLHHP');
        $user->setPassword('Ie1FDLHHP');
        $user->addRole('ROLE_WIZARD');
        $user->setValidationDate(new \Datetime('2017-04-24'));
        $user->setValidated(true);
        $user->setActive(false);
        $user->setApiToken('6a41d94d2a0d45a-41a5-d2ad4ad-d52a-d4ad');

        $badge = $this->createMock(Badge::class);
        $badge->method('getId')
              ->willReturn(35);

        $user->addBadge($badge);

        static::assertContains($badge, $user->getBadges());
    }
}

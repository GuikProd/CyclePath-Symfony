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

use App\Models\User;
use App\Models\Image;
use App\Models\Badge;
use App\Models\Location;
use PHPUnit\Framework\TestCase;

/**
 * Class ImageTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ImageTest extends TestCase
{
    public function testInstantiation()
    {
        $image = new Image();

        $image->setAlt('New Image !');
        $image->setUrl('https://localhost/public/images/new_image.png');

        static::assertNull($image->getId());
        static::assertEquals('New Image !', $image->getAlt());
        static::assertEquals('https://localhost/public/images/new_image.png', $image->getUrl());
    }

    public function testUserRelation()
    {
        $image = new Image();

        $image->setAlt('New Image !');
        $image->setUrl('https://localhost/public/images/new_image.png');

        $user = $this->createMock(User::class);
        $user->method('getId')
             ->willReturn(12);

        $image->setUser($user);

        static::assertEquals(12, $image->getUser()->getId());
    }

    public function testBadgeRelation()
    {
        $image = new Image();

        $image->setAlt('New Image !');
        $image->setUrl('https://localhost/public/images/new_image.png');

        $badge = $this->createMock(Badge::class);
        $badge->method('getId')
              ->willReturn(35);

        $image->setBadge($badge);

        static::assertEquals(35, $image->getBadge()->getId());
    }

    public function testLocationRelation()
    {
        $image = new Image();

        $image->setAlt('New Image !');
        $image->setUrl('https://localhost/public/images/new_image.png');

        $location = $this->createMock(Location::class);
        $location->method('getId')
                 ->willReturn(90);

        $image->setLocation($location);

        static::assertEquals($location, $image->getLocation());
    }
}

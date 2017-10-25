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
use App\Models\Badge;
use App\Models\Image;
use PHPUnit\Framework\TestCase;

/**
 * Class BadgeTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BadgeTest extends TestCase
{
    public function testInstantiation()
    {
        $badge = new Badge();

        $badge->setLabel('Best climber !');
        $badge->setLevel(4);

        static::assertNull($badge->getId());
        static::assertEquals('Best climber !', $badge->getLabel());
        static::assertEquals(4, $badge->getLevel());
    }

    public function testImageRelation()
    {
        $badge = new Badge();

        $badge->setLabel('Best climber !');
        $badge->setLevel(4);

        $image = $this->createMock(Image::class);
        $image->method('getAlt')
              ->willReturn('New Image');

        $badge->setImage($image);

        static::assertEquals('New Image', $badge->getImage()->getAlt());
    }

    public function testUserRelation()
    {
        $badge = new Badge();

        $badge->setLabel('Best climber !');
        $badge->setLevel(4);

        $user = $this->createMock(User::class);
        $user->method('getId')
             ->willReturn(35);

        $badge->addUser($user);

        static::assertContains($user, $badge->getUsers());
    }
}

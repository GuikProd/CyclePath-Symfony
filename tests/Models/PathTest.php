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
use App\Models\Path;
use App\Models\Location;
use PHPUnit\Framework\TestCase;

/**
 * Class PathTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class PathTest extends TestCase
{
    public function testInstantiation()
    {
        $path = new Path();

        $path->setEndingDate(new \DateTime('2017-04-24'));
        $path->setDistance(3000.560);
        $path->setDuration('2 heures, 25 minutes et 43 secondes.');
        $path->setAltitude(100.25);

        static::assertNull($path->getId());
        static::assertEquals(3000.560, $path->getDistance());
        static::assertEquals('2 heures, 25 minutes et 43 secondes.', $path->getDuration());
        static::assertEquals(100.25, $path->getAltitude());
        static::assertFalse($path->getFavorite());
    }

    public function testUserRelation()
    {
        $path = new Path();

        $path->setEndingDate(new \DateTime('2017-04-24'));
        $path->setDistance(3000.560);
        $path->setDuration('2 heures, 25 minutes et 43 secondes.');
        $path->setAltitude(100);
        $path->setFavorite(false);

        $user = $this->createMock(User::class);
        $user->method('getId')
             ->willReturn(34);

        $path->setUser($user);

        static::assertEquals(34, $path->getUser()->getId());
    }

    public function testLocationRelation()
    {
        $path = new Path();

        $path->setEndingDate(new \DateTime('2017-04-24'));
        $path->setDistance(3000.560);
        $path->setDuration('2 heures, 25 minutes et 43 secondes.');
        $path->setAltitude(100);
        $path->setFavorite(false);

        $location = $this->createMock(Location::class);
        $location->method('getId')
                 ->willReturn(56);

        $path->addLocation($location);

        static::assertContains($location, $path->getLocations());
    }
}

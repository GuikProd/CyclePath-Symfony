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

use App\Models\Path;
use App\Models\Image;
use App\Models\Location;
use PHPUnit\Framework\TestCase;

/**
 * Class LocationTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class LocationTest extends TestCase
{
    public function testInstantiation()
    {
        $location = new Location();

        $location->setTimestamp(10000000000);
        $location->setLatitude(300.56);
        $location->setLongitude(300.56);

        static::assertNull($location->getId());
        static::assertEquals(10000000000, $location->getTimestamp());
        static::assertEquals(300.56, $location->getLatitude());
        static::assertEquals(300.56, $location->getLongitude());
    }

    public function testPathRelation()
    {
        $location = new Location();

        $location->setTimestamp(10000000000);
        $location->setLatitude(300.56);
        $location->setLongitude(300.56);

        $path = $this->createMock(Path::class);
        $path->method('getId')
             ->willReturn(80);

        $location->setPath($path);

        static::assertEquals($path, $location->getPath());
    }

    public function testLocationImageRelation()
    {
        $location = new Location();

        $location->setTimestamp(10000000000);
        $location->setLatitude(300.56);
        $location->setLongitude(300.56);

        $locationImage = $this->createMock(Image::class);
        $locationImage->method('getId')
                      ->willReturn(89);

        $location->addImage($locationImage);

        static::assertContains($locationImage, $location->getImages());
    }
}

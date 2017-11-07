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

namespace App\Tests\Models;

use PHPUnit\Framework\TestCase;
use App\Interactors\PathInteractor;
use App\Interactors\ImageInteractor;
use App\Interactors\LocationInteractor;

/**
 * Class LocationInteractorTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class LocationInteractorTest extends TestCase
{
    public function testInstantiation()
    {
        $locationInteractor = new LocationInteractor();

        $locationInteractor->setTimestamp(10000000000);
        $locationInteractor->setLatitude(300.56);
        $locationInteractor->setLongitude(300.56);

        static::assertNull($locationInteractor->getId());
        static::assertEquals(10000000000, $locationInteractor->getTimestamp());
        static::assertEquals(300.56, $locationInteractor->getLatitude());
        static::assertEquals(300.56, $locationInteractor->getLongitude());
    }

    public function testPathRelation()
    {
        $locationInteractor = new LocationInteractor();

        $locationInteractor->setTimestamp(10000000000);
        $locationInteractor->setLatitude(300.56);
        $locationInteractor->setLongitude(300.56);

        $pathInteractor = $this->createMock(PathInteractor::class);
        $pathInteractor->method('getId')
                       ->willReturn(80);

        $locationInteractor->setPath($pathInteractor);

        static::assertEquals(80, $locationInteractor->getPath()->getId());
    }

    public function testImageRelation()
    {
        $locationInteractor = new LocationInteractor();

        $locationInteractor->setTimestamp(10000000000);
        $locationInteractor->setLatitude(300.56);
        $locationInteractor->setLongitude(300.56);

        $imageInteractor = $this->createMock(ImageInteractor::class);
        $imageInteractor->method('getId')
                        ->willReturn(89);

        $locationInteractor->addImage($imageInteractor);

        static::assertContains($imageInteractor, $locationInteractor->getImages());

        $locationInteractor->removeImage($imageInteractor);

        static::assertEmpty($locationInteractor->getImages());
    }
}

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
use App\Interactors\UserInteractor;
use App\Interactors\LocationInteractor;

/**
 * Class PathInteractorTest.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class PathInteractorTest extends TestCase
{
    public function testInstantiation()
    {
        $pathInteractor = new PathInteractor();

        $pathInteractor->setStartingDate(new \DateTime('2017-05-25'));
        $pathInteractor->setEndingDate(new \DateTime('2017-04-24'));
        $pathInteractor->setDistance(3000.560);
        $pathInteractor->setDuration('2 heures, 25 minutes et 43 secondes.');
        $pathInteractor->setAltitude(100.25);
        $pathInteractor->setFavorite(false);

        static::assertNull($pathInteractor->getId());
        static::assertEquals('25-05-2017 12:00:00', $pathInteractor->getStartingDate());
        static::assertEquals(3000.560, $pathInteractor->getDistance());
        static::assertEquals('2 heures, 25 minutes et 43 secondes.', $pathInteractor->getDuration());
        static::assertEquals(100.25, $pathInteractor->getAltitude());
        static::assertFalse($pathInteractor->getFavorite());
    }

    public function testUserRelation()
    {
        $pathInteractor = new PathInteractor();

        $pathInteractor->setStartingDate(new \DateTime('2017-05-25'));
        $pathInteractor->setEndingDate(new \DateTime('2017-04-24'));
        $pathInteractor->setDistance(3000.560);
        $pathInteractor->setDuration('2 heures, 25 minutes et 43 secondes.');
        $pathInteractor->setAltitude(100);
        $pathInteractor->setFavorite(false);

        $userInteractor = $this->createMock(UserInteractor::class);
        $userInteractor->method('getId')
                       ->willReturn(34);

        $pathInteractor->setUser($userInteractor);

        static::assertEquals(34, $pathInteractor->getUser()->getId());
    }

    public function testLocationRelation()
    {
        $pathInteractor = new PathInteractor();

        $pathInteractor->setStartingDate(new \DateTime('2017-05-25'));
        $pathInteractor->setEndingDate(new \DateTime('2017-04-24'));
        $pathInteractor->setDistance(3000.560);
        $pathInteractor->setDuration('2 heures, 25 minutes et 43 secondes.');
        $pathInteractor->setAltitude(100);
        $pathInteractor->setFavorite(false);

        $locationInteractor = $this->createMock(LocationInteractor::class);
        $locationInteractor->method('getId')
                           ->willReturn(56);

        $pathInteractor->addLocation($locationInteractor);

        static::assertEquals(56, $pathInteractor->getLocations()->offsetGet(0)->getId());

        $pathInteractor->removeLocation($locationInteractor);

        static::assertEmpty($pathInteractor->getLocations());
    }
}

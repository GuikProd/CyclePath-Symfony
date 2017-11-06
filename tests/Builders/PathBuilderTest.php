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

use App\Builders\PathBuilder;
use PHPUnit\Framework\TestCase;
use App\Models\Interfaces\PathInterface;
use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\LocationInterface;

/**
 * Class PathBuilderTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class PathBuilderTest extends TestCase
{
    public function testInstantiation()
    {
        $builder = new PathBuilder();

        $builder
            ->create()
            ->withStartingDate(new \DateTime('2017-04-21'))
            ->withEndingDate(new \DateTime('2017-04-22'))
            ->withAltitude(245.560)
            ->withDistance(3000.56)
            ->withDuration('2 days, 12 hours and 25 minutes')
            ->withFavorite(false)
            ->build()
        ;

        static::assertEquals('21-04-2017 12:00:00', $builder->build()->getStartingDate());
        static::assertEquals('22-04-2017 12:00:00', $builder->build()->getEndingDate());
        static::assertEquals(245.560, $builder->build()->getAltitude());
        static::assertEquals(3000.56, $builder->build()->getDistance());
        static::assertEquals('2 days, 12 hours and 25 minutes', $builder->build()->getDuration());
        static::assertFalse($builder->build()->getFavorite());
    }

    public function testSetter()
    {
        $builder = new PathBuilder();
        $pathAbstract = $this->createMock(PathInterface::class);
        $pathAbstract->method('getId')
                     ->willReturn(98);

        $builder
            ->setPath($pathAbstract)
            ->withStartingDate(new \DateTime('2017-04-21'))
            ->withEndingDate(new \DateTime('2017-04-22'))
            ->withAltitude(245.560)
            ->withDistance(3000.56)
            ->withDuration('2 days, 12 hours and 25 minutes')
            ->withFavorite(false)
            ->build()
        ;

        static::assertEquals(98, $builder->build()->getId());
    }

    public function testLocationRelation()
    {
        $builder = new PathBuilder();
        $locationAbstract = $this->createMock(LocationInterface::class);
        $locationAbstract->method('getId')
                         ->willReturn(87);

        $builder
            ->create()
            ->withLocation($locationAbstract)
            ->withStartingDate(new \DateTime('2017-04-21'))
            ->withEndingDate(new \DateTime('2017-04-22'))
            ->withAltitude(245.560)
            ->withDistance(3000.56)
            ->withDuration('2 days, 12 hours and 25 minutes')
            ->build()
        ;

        static::assertEquals(87, $builder->build()->getLocations()->offsetGet(0)->getId());
    }

    public function testUserRelation()
    {
        $builder = new PathBuilder();
        $userAbstract = $this->createMock(UserInterface::class);
        $userAbstract->method('getId')
                     ->willReturn(87);

        $builder
            ->create()
            ->withUser($userAbstract)
            ->withStartingDate(new \DateTime('2017-04-21'))
            ->withEndingDate(new \DateTime('2017-04-22'))
            ->withAltitude(245.560)
            ->withDistance(3000.56)
            ->withDuration('2 days, 12 hours and 25 minutes')
            ->build()
        ;

        static::assertEquals(87, $builder->build()->getUser()->getId());
    }
}

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

use PHPUnit\Framework\TestCase;
use App\Builders\LocationBuilder;
use App\Models\Interfaces\PathInterface;
use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\LocationInterface;

/**
 * Class LocationBuilderTest.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class LocationBuilderTest extends TestCase
{
    public function testInstantiation()
    {
        $builder = new LocationBuilder();

        $builder
            ->create()
            ->withTimestamp(108909302920)
            ->withLatitude(143.56700)
            ->withLongitude(345.677899)
            ->build()
        ;

        static::assertEquals(108909302920, $builder->build()->getTimestamp());
        static::assertEquals(143.56700, $builder->build()->getLatitude());
        static::assertEquals(345.677899, $builder->build()->getLongitude());
    }

    public function testSetter()
    {
        $builder = new LocationBuilder();

        $locationAbstract = $this->createMock(LocationInterface::class);
        $locationAbstract->method('getId')
                         ->willReturn(90);

        $builder
            ->create()
            ->setLocation($locationAbstract)
            ->build()
        ;

        static::assertEquals(90, $builder->build()->getId());
    }

    public function testPathRelation()
    {
        $builder = new LocationBuilder();

        $pathAbstract = $this->createMock(PathInterface::class);
        $pathAbstract->method('getId')
                     ->willReturn(90);

        $builder
            ->create()
            ->withTimestamp(108909302920)
            ->withLatitude(143.56700)
            ->withLongitude(345.677899)
            ->build()
        ;

        $builder->withPath($pathAbstract);

        static::assertEquals(90, $builder->build()->getPath()->getId());
    }

    public function testImageRelation()
    {
        $builder = new LocationBuilder();

        $imageAbstract = $this->createMock(ImageInterface::class);
        $imageAbstract->method('getId')
                      ->willReturn(90);

        $builder
            ->create()
            ->withTimestamp(108909302920)
            ->withLatitude(143.56700)
            ->withLongitude(345.677899)
            ->build()
        ;

        $builder->withImage($imageAbstract);

        static::assertEquals(90, $builder->build()->getImages()->offsetGet(0)->getId());
    }
}

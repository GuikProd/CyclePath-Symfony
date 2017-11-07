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

use App\Builders\BadgeBuilder;
use PHPUnit\Framework\TestCase;
use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\BadgeInterface;
use App\Models\Interfaces\ImageInterface;

/**
 * Class BadgeBuilderTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BadgeBuilderTest extends TestCase
{
    public function testInstantiation()
    {
        $builder = new BadgeBuilder();

        $builder
            ->create()
            ->withLabel('New Badge')
            ->withLevel(10)
            ->withObtentionDate(new \DateTime('2017-05-24'))
            ->build()
        ;

        static::assertNull($builder->build()->getId());
        static::assertEquals('New Badge', $builder->build()->getLabel());
        static::assertEquals(10, $builder->build()->getLevel());
        static::assertEquals('24-05-2017 12:00:00', $builder->build()->getObtentionDate());
    }

    public function testSetter()
    {
        $badgeAbstract = $this->createMock(BadgeInterface::class);
        $badgeAbstract->method('getId')
                      ->willReturn(10);

        $builder = new BadgeBuilder();

        $builder
            ->setBadge($badgeAbstract)
            ->build()
        ;

        static::assertEquals($badgeAbstract, $builder->build());
    }

    public function testUserRelation()
    {
        $builder = new BadgeBuilder();
        $userInteractor = $this->createMock(UserInterface::class);
        $userInteractor->method('getId')
             ->willReturn(10);

        $builder
            ->create()
            ->withLabel('New Badge')
            ->withLevel(10)
            ->withObtentionDate(new \DateTime('2017-05-24'))
            ->withUser($userInteractor)
            ->build()
        ;

        static::assertEquals($userInteractor, $builder->build()->getUser());
    }

    public function testImageRelation()
    {
        $builder = new BadgeBuilder();
        $imageInteractor = $this->createMock(ImageInterface::class);
        $imageInteractor->method('getId')
                        ->willReturn(10);

        $builder
            ->create()
            ->withLabel('New Badge')
            ->withLevel(10)
            ->withObtentionDate(new \DateTime('2017-05-24'))
            ->withImage($imageInteractor)
            ->build()
        ;

        static::assertEquals($imageInteractor, $builder->build()->getImage());
    }
}

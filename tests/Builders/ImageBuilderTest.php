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

use App\Builders\ImageBuilder;
use PHPUnit\Framework\TestCase;
use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\BadgeInterface;
use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\LocationInterface;

/**
 * Class ImageBuilderTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ImageBuilderTest extends TestCase
{
    public function testInstantiation()
    {
        $builder = new ImageBuilder();

        $builder
            ->create()
            ->withCreationDate(new \DateTime('2017-04-25'))
            ->withLabel('New Image !')
            ->withAlt('Image !')
            ->withUrl('/api/public/images/newImage.png')
        ;

        static::assertEquals('25-04-2017 12:00:00', $builder->build()->getCreationDate());
        static::assertEquals('New Image !', $builder->build()->getLabel());
        static::assertEquals('Image !', $builder->build()->getAlt());
        static::assertEquals('/api/public/images/newImage.png', $builder->build()->getUrl());
    }

    public function testSetter()
    {
        $builder = new ImageBuilder();
        $imageAbstract = $this->createMock(ImageInterface::class);
        $imageAbstract->method('getId')
                      ->willReturn(10);

        $builder
            ->setImage($imageAbstract)
            ->build()
        ;

        static::assertEquals(10, $builder->build()->getId());
    }

    public function testUserRelation()
    {
        $builder = new ImageBuilder();
        $userAbstract = $this->createMock(UserInterface::class);
        $userAbstract->method('getId')
                     ->willReturn(10);

        $builder
            ->create()
            ->withCreationDate(new \DateTime('2017-04-25'))
            ->withLabel('New Image !')
            ->withAlt('Image !')
            ->withUrl('/api/public/images/newImage.png')
            ->withUser($userAbstract)
        ;

        static::assertEquals($userAbstract, $builder->build()->getUser());
    }

    public function testBadgeRelation()
    {
        $builder = new ImageBuilder();
        $badgeAbstract = $this->createMock(BadgeInterface::class);
        $badgeAbstract->method('getId')
                      ->willReturn(10);

        $builder
            ->create()
            ->withCreationDate(new \DateTime('2017-04-25'))
            ->withLabel('New Image !')
            ->withAlt('Image !')
            ->withUrl('/api/public/images/newImage.png')
            ->withBadge($badgeAbstract)
        ;

        static::assertEquals($badgeAbstract, $builder->build()->getBadge());
    }

    public function testLocationRelation()
    {
        $builder = new ImageBuilder();
        $locationAbstract = $this->createMock(LocationInterface::class);
        $locationAbstract->method('getId')
                         ->willReturn(10);

        $builder
            ->create()
            ->withCreationDate(new \DateTime('2017-04-25'))
            ->withLabel('New Image !')
            ->withAlt('Image !')
            ->withUrl('/api/public/images/newImage.png')
            ->withLocation($locationAbstract)
        ;

        static::assertEquals($locationAbstract, $builder->build()->getLocation());
    }
}

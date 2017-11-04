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

namespace App\Tests\Interactors;

use PHPUnit\Framework\TestCase;
use App\Interactors\UserInteractor;
use App\Interactors\ImageInteractor;
use App\Interactors\BadgeInteractor;
use App\Interactors\LocationInteractor;

/**
 * Class ImageInteractorTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ImageInteractorTest extends TestCase
{
    public function testInstantiation()
    {
        $imageInteractor = new ImageInteractor();

        $imageInteractor->setCreationDate(new \DateTime('2017-05-24'));
        $imageInteractor->setLabel('New Image !');
        $imageInteractor->setAlt('New Image !');
        $imageInteractor->setUrl('https://localhost/public/images/new_image.png');

        static::assertNull($imageInteractor->getId());
        static::assertEquals('24-05-2017 12:00:00', $imageInteractor->getCreationDate());
        static::assertEquals('New Image !', $imageInteractor->getLabel());
        static::assertEquals('New Image !', $imageInteractor->getAlt());
        static::assertEquals('https://localhost/public/images/new_image.png', $imageInteractor->getUrl());
    }

    public function testUserRelation()
    {
        $imageInteractor = new ImageInteractor();

        $imageInteractor->setCreationDate(new \DateTime('2017-05-24'));
        $imageInteractor->setLabel('New Image !');
        $imageInteractor->setAlt('New Image !');
        $imageInteractor->setUrl('https://localhost/public/images/new_image.png');

        $userInteractor = $this->createMock(UserInteractor::class);
        $userInteractor->method('getId')
                       ->willReturn(12);

        $imageInteractor->setUser($userInteractor);

        static::assertEquals(12, $imageInteractor->getUser()->getId());
    }

    public function testBadgeRelation()
    {
        $image = new ImageInteractor();

        $image->setLabel('New Image !');
        $image->setAlt('New Image !');
        $image->setUrl('https://localhost/public/images/new_image.png');

        $badgeInteractor = $this->createMock(BadgeInteractor::class);
        $badgeInteractor->method('getId')
                        ->willReturn(35);

        $image->setBadge($badgeInteractor);

        static::assertEquals(35, $image->getBadge()->getId());
    }

    public function testLocationRelation()
    {
        $imageInteractor = new ImageInteractor();

        $imageInteractor->setLabel('New Image !');
        $imageInteractor->setAlt('New Image !');
        $imageInteractor->setUrl('https://localhost/public/images/new_image.png');

        $locationInteractor = $this->createMock(LocationInteractor::class);
        $locationInteractor->method('getId')
                           ->willReturn(90);

        $imageInteractor->setLocation($locationInteractor);

        static::assertEquals(90, $imageInteractor->getLocation()->getId());
    }
}

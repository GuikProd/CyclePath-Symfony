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
use App\Interactors\UserInteractor;
use App\Interactors\BadgeInteractor;
use App\Interactors\ImageInteractor;

/**
 * Class BadgeInteractorTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BadgeInteractorTest extends TestCase
{
    public function testInstantiation()
    {
        $badgeInteractor = new BadgeInteractor();

        $badgeInteractor->setObtentionDate(new \DateTime('2016-04-21'));
        $badgeInteractor->setLabel('Best climber !');
        $badgeInteractor->setLevel(4);

        static::assertNull($badgeInteractor->getId());
        static::assertEquals('21-04-2016 12:00:00', $badgeInteractor->getObtentionDate());
        static::assertEquals('Best climber !', $badgeInteractor->getLabel());
        static::assertEquals(4, $badgeInteractor->getLevel());
    }

    public function testImageRelation()
    {
        $badgeInteractor = new BadgeInteractor();

        $badgeInteractor->setLabel('Best climber !');
        $badgeInteractor->setLevel(4);

        $imageInteractor = $this->createMock(ImageInteractor::class);
        $imageInteractor->method('getAlt')
                        ->willReturn('New Image');

        $badgeInteractor->setImage($imageInteractor);

        static::assertEquals('New Image', $badgeInteractor->getImage()->getAlt());
    }

    public function testUserRelation()
    {
        $badgeInteractor = new BadgeInteractor();

        $badgeInteractor->setLabel('Best climber !');
        $badgeInteractor->setLevel(4);

        $userInteractor = $this->createMock(UserInteractor::class);
        $userInteractor->method('getId')
                       ->willReturn(35);

        $badgeInteractor->setUser($userInteractor);

        static::assertEquals(35, $badgeInteractor->getUser()->getId());
    }
}

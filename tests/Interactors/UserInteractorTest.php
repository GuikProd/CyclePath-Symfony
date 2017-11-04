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
use App\Interactors\ImageInteractor;
use App\Interactors\BadgeInteractor;

/**
 * Class UserInteractorTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserInteractorTest extends TestCase
{
    public function testInstantiation()
    {
        $userInteractor = new UserInteractor();
        
        $userInteractor->setFirstname('Harry');
        $userInteractor->setLastname('Potter');
        $userInteractor->setUsername('HP');
        $userInteractor->setEmail('hp@gmail.com');
        $userInteractor->setPlainPassword('Ie1FDLHHP');
        $userInteractor->setPassword('Ie1FDLHHP');
        $userInteractor->addRole('ROLE_WIZARD');
        $userInteractor->setCreationDate(new \DateTime('2015-04-23'));
        $userInteractor->setValidationDate(new \Datetime('2017-04-24'));
        $userInteractor->setValidated(true);
        $userInteractor->setActive(false);
        $userInteractor->setApiToken('6a41d94d2a0d45a-41a5-d2ad4ad-d52a-d4ad');
        $userInteractor->setValidationToken('2a4194da1a9d84da9d8d2a7d29addaad4da2');
        $userInteractor->setResetToken('9a1da=9d9ad9d41adx91d361d4167aad6ad4d');

        static::assertNull($userInteractor->getId());
        static::assertEquals('Harry', $userInteractor->getFirstname());
        static::assertEquals('Potter', $userInteractor->getLastname());
        static::assertEquals('HP', $userInteractor->getUsername());
        static::assertEquals('hp@gmail.com', $userInteractor->getEmail());
        static::assertEquals('Ie1FDLHHP', $userInteractor->getPlainPassword());
        static::assertEquals('Ie1FDLHHP', $userInteractor->getPassword());
        static::assertContains('ROLE_WIZARD', $userInteractor->getRoles());
        static::assertEquals('23-04-2015 12:00:00', $userInteractor->getCreationDate());
        static::assertEquals('24-04-2017 12:00:00', $userInteractor->getValidationDate());
        static::assertTrue($userInteractor->getValidated());
        static::assertFalse($userInteractor->getActive());
        static::assertEquals('6a41d94d2a0d45a-41a5-d2ad4ad-d52a-d4ad', $userInteractor->getApiToken());
        static::assertEquals('2a4194da1a9d84da9d8d2a7d29addaad4da2', $userInteractor->getValidationToken());
        static::assertEquals('9a1da=9d9ad9d41adx91d361d4167aad6ad4d', $userInteractor->getResetToken());
    }

    public function testImageRelation()
    {
        $userInteractor = new UserInteractor();

        $userInteractor->setFirstname('Harry');
        $userInteractor->setLastname('Potter');
        $userInteractor->setUsername('HP');
        $userInteractor->setEmail('hp@gmail.com');
        $userInteractor->setPlainPassword('Ie1FDLHHP');
        $userInteractor->setPassword('Ie1FDLHHP');
        $userInteractor->addRole('ROLE_WIZARD');
        $userInteractor->setValidationDate(new \Datetime('2017-04-24'));
        $userInteractor->setValidated(true);
        $userInteractor->setActive(false);
        $userInteractor->setApiToken('6a41d94d2a0d45a-41a5-d2ad4ad-d52a-d4ad');

        $imageInteractor = $this->createMock(ImageInteractor::class);
        $imageInteractor->method('getId')
                        ->willReturn(65);

        $userInteractor->setImage($imageInteractor);

        static::assertEquals(65, $userInteractor->getImage()->getId());
    }

    public function testPathRelation()
    {
        $userInteractor = new UserInteractor();

        $userInteractor->setFirstname('Harry');
        $userInteractor->setLastname('Potter');
        $userInteractor->setUsername('HP');
        $userInteractor->setEmail('hp@gmail.com');
        $userInteractor->setPlainPassword('Ie1FDLHHP');
        $userInteractor->setPassword('Ie1FDLHHP');
        $userInteractor->addRole('ROLE_WIZARD');
        $userInteractor->setValidationDate(new \Datetime('2017-04-24'));
        $userInteractor->setValidated(true);
        $userInteractor->setActive(false);
        $userInteractor->setApiToken('6a41d94d2a0d45a-41a5-d2ad4ad-d52a-d4ad');

        $pathInteractor = $this->createMock(PathInteractor::class);
        $pathInteractor->method('getId')
                       ->willReturn(100);

        $userInteractor->addPath($pathInteractor);

        static::assertEquals(100, $userInteractor->getPaths()->offsetGet(0)->getId());

        $userInteractor->removePath($pathInteractor);

        static::assertEmpty($userInteractor->getPaths());
    }

    public function testBadgeRelation()
    {
        $userInteractor = new UserInteractor();

        $userInteractor->setFirstname('Harry');
        $userInteractor->setLastname('Potter');
        $userInteractor->setUsername('HP');
        $userInteractor->setEmail('hp@gmail.com');
        $userInteractor->setPlainPassword('Ie1FDLHHP');
        $userInteractor->setPassword('Ie1FDLHHP');
        $userInteractor->addRole('ROLE_WIZARD');
        $userInteractor->setValidationDate(new \Datetime('2017-04-24'));
        $userInteractor->setValidated(true);
        $userInteractor->setActive(false);
        $userInteractor->setApiToken('6a41d94d2a0d45a-41a5-d2ad4ad-d52a-d4ad');

        $badgeInteractor = $this->createMock(BadgeInteractor::class);
        $badgeInteractor->method('getId')
                        ->willReturn(35);

        $userInteractor->addBadge($badgeInteractor);

        static::assertEquals(35, $userInteractor->getBadges()->offsetGet(0)->getId());

        $userInteractor->removeBadge($badgeInteractor);

        static::assertEmpty($userInteractor->getBadges());
    }
}

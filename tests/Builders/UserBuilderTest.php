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

use App\Builders\UserBuilder;
use PHPUnit\Framework\TestCase;
use App\Models\Interfaces\PathInterface;
use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\BadgeInterface;
use App\Models\Interfaces\ImageInterface;

/**
 * Class UserBuilderTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserBuilderTest extends TestCase
{
    public function testInstantiation()
    {
        $builder = new UserBuilder();

        $builder
            ->create()
            ->withFirstname('Harry')
            ->withLastname('Potter')
            ->withUsername('HP')
            ->withEmail('hp@gmail.com')
            ->withPlainPassword('Ie1FDLHHP')
            ->withPassword('Ie1FDLHHP')
            ->withRole('ROLE_USER')
            ->withCreationDate(new \DateTime('2017-04-15'))
            ->withValidationDate(new \DateTime('2017-04-23'))
            ->withValidated(true)
            ->withActive(true)
            ->withApiToken('2a9d91c6419da242a84v8brt4vza9c9caca14ca9')
            ->withValidationToken('2a9d91c6419da242a84v8brt4vza9c9caca14ca9')
            ->withResetToken('2a9d91c6419da242a84v8brt4vza9c9caca14ca9')
        ;

        static::assertNull($builder->build()->getId());
        static::assertEquals('Harry', $builder->build()->getFirstname());
        static::assertEquals('Potter', $builder->build()->getLastname());
    }

    public function testSetter()
    {
        $builder = new UserBuilder();

        $userAbstract = $this->createMock(UserInterface::class);
        $userAbstract->method('getId')
                     ->willReturn(98);

        $builder
            ->setUser($userAbstract)
        ;

        static::assertEquals(98, $builder->build()->getId());
    }

    public function testImageRelation()
    {
        $builder = new UserBuilder();

        $imageAbstract = $this->createMock(ImageInterface::class);
        $imageAbstract->method('getId')
                      ->willReturn(90);

        $builder
            ->create()
            ->withFirstname('Harry')
            ->withLastname('Potter')
            ->withUsername('HP')
            ->withEmail('hp@gmail.com')
            ->withPlainPassword('Ie1FDLHHP')
            ->withPassword('Ie1FDLHHP')
            ->withRole('ROLE_USER')
            ->withCreationDate(new \DateTime('2017-04-15'))
            ->withValidationDate(new \DateTime('2017-04-23'))
            ->withValidated(true)
            ->withActive(true)
            ->withApiToken('2a9d91c6419da242a84v8brt4vza9c9caca14ca9')
            ->withValidationToken('2a9d91c6419da242a84v8brt4vza9c9caca14ca9')
            ->withResetToken('2a9d91c6419da242a84v8brt4vza9c9caca14ca9')
            ->withImage($imageAbstract)
        ;

        static::assertEquals(90, $builder->build()->getImage()->getId());
    }

    public function testBadgeRelation()
    {
        $builder = new UserBuilder();

        $badgeAbstract = $this->createMock(BadgeInterface::class);
        $badgeAbstract->method('getId')
            ->willReturn(90);

        $builder
            ->create()
            ->withFirstname('Harry')
            ->withLastname('Potter')
            ->withUsername('HP')
            ->withEmail('hp@gmail.com')
            ->withPlainPassword('Ie1FDLHHP')
            ->withPassword('Ie1FDLHHP')
            ->withRole('ROLE_USER')
            ->withCreationDate(new \DateTime('2017-04-15'))
            ->withValidationDate(new \DateTime('2017-04-23'))
            ->withValidated(true)
            ->withActive(true)
            ->withApiToken('2a9d91c6419da242a84v8brt4vza9c9caca14ca9')
            ->withValidationToken('2a9d91c6419da242a84v8brt4vza9c9caca14ca9')
            ->withResetToken('2a9d91c6419da242a84v8brt4vza9c9caca14ca9')
            ->withBadge($badgeAbstract)
        ;

        static::assertEquals(90, $builder->build()->getBadges()->offsetGet(0)->getId());
    }

    public function testPathRelation()
    {
        $builder = new UserBuilder();

        $pathAbstract = $this->createMock(PathInterface::class);
        $pathAbstract->method('getId')
                     ->willReturn(90);

        $builder
            ->create()
            ->withFirstname('Harry')
            ->withLastname('Potter')
            ->withUsername('HP')
            ->withEmail('hp@gmail.com')
            ->withPlainPassword('Ie1FDLHHP')
            ->withPassword('Ie1FDLHHP')
            ->withRole('ROLE_USER')
            ->withCreationDate(new \DateTime('2017-04-15'))
            ->withValidationDate(new \DateTime('2017-04-23'))
            ->withValidated(true)
            ->withActive(true)
            ->withApiToken('2a9d91c6419da242a84v8brt4vza9c9caca14ca9')
            ->withValidationToken('2a9d91c6419da242a84v8brt4vza9c9caca14ca9')
            ->withResetToken('2a9d91c6419da242a84v8brt4vza9c9caca14ca9')
            ->withPath($pathAbstract)
        ;

        static::assertEquals(90, $builder->build()->getPaths()->offsetGet(0)->getId());
    }
}

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

namespace App\Tests\Resolvers;

use App\Resolvers\BadgeResolver;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class BadgeResolverTest.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BadgeResolverTest extends KernelTestCase
{
    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        static::bootKernel();
    }

    public function testResolverExist()
    {
        static::assertInstanceOf(
            BadgeResolver::class,
            static::$kernel->getContainer()->get('graphql.badge_resolver')
        );
    }

    public function testResolverAttributes()
    {
        static::assertObjectHasAttribute(
            'entityManagerInterface',
            static::$kernel->getContainer()->get('graphql.badge_resolver')
        );
    }
}

<?php

/*
 * This file is part of the CyclePath project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Resolvers;

use App\Resolvers\ImageResolver;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class ImageResolverTest.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ImageResolverTest extends KernelTestCase
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
            ImageResolver::class,
            static::$kernel->getContainer()->get('graphql.image_resolver')
        );
    }

    public function testResolverAttributes()
    {
        static::assertObjectHasAttribute(
            'entityManagerInterface',
            static::$kernel->getContainer()->get('graphql.image_resolver')
        );
    }
}

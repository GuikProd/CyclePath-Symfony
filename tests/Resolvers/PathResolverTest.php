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

use App\Resolvers\PathResolver;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class PathResolverTest.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class PathResolverTest extends KernelTestCase
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
            PathResolver::class,
            static::$kernel->getContainer()->get('PathResolver')
        );
    }

    public function testResolverAttributes()
    {
        static::assertObjectHasAttribute(
            'entityManagerInterface',
            static::$kernel->getContainer()->get('PathResolver')
        );
    }
}

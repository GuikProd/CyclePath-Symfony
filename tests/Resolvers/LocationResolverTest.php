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

use App\Resolvers\LocationResolver;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class LocationResolverTest.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class LocationResolverTest extends KernelTestCase
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
            LocationResolver::class,
            static::$kernel->getContainer()->get('LocationResolver')
        );
    }

    public function testResolverAttributes()
    {
        static::assertObjectHasAttribute(
            'entityManagerInterface',
            static::$kernel->getContainer()->get('LocationResolver')
        );
    }
}

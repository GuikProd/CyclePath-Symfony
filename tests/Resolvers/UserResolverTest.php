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

use App\Resolvers\UserResolver;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class UserResolverTest.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserResolverTest extends KernelTestCase
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
            UserResolver::class,
            static::$kernel->getContainer()->get('UserResolver')
        );
    }

    public function testResolverAttributes()
    {
        static::assertObjectHasAttribute(
            'userGatewayInterface',
            static::$kernel->getContainer()->get('UserResolver')
        );
    }
}

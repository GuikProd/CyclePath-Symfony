<?php

/*
 * This file is part of the CyclePath project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Repository;

use App\Repository\BadgeRepository;
use App\Interactors\BadgeInteractor;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class BadgeRepositoryTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BadgeRepositoryTest extends KernelTestCase
{
    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        static::bootKernel();
    }

    public function testRepositoryExist()
    {
        static::assertInstanceOf(
            BadgeRepository::class,
            static::$kernel->getContainer()->get('doctrine.orm.entity_manager')
                                           ->getRepository(BadgeInteractor::class)
        );
    }
}

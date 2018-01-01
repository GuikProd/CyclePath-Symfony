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

namespace App\DataFixtures\ORM;

use App\Builders\LocationBuilder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LocationFixtures.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class LocationFixtures extends Fixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $location = new LocationBuilder();

        $location
            ->withTimestamp(100000)
            ->withLatitude(300.56)
            ->withLongitude(300.56)
            ->withPath($this->getReference('path'));

        $location_II = new LocationBuilder();

        $location_II
            ->withTimestamp(300000)
            ->withLatitude(354.56)
            ->withLongitude(300.56)
            ->withPath($this->getReference('path'));

        $location_III = new LocationBuilder();

        $location_III
            ->withTimestamp(400000)
            ->withLatitude(324.56)
            ->withLongitude(300.56)
            ->withPath($this->getReference('path'));

        $location_IV = new LocationBuilder();

        $location_IV
            ->withTimestamp(2000000)
            ->withLatitude(400.56)
            ->withLongitude(300.56)
            ->withPath($this->getReference('path'));

        $manager->persist($location->build());
        $manager->persist($location_II->build());
        $manager->persist($location_III->build());
        $manager->persist($location_IV->build());

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            PathFixtures::class,
        ];
    }
}

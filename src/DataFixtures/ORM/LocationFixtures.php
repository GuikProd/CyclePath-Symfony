<?php

/*
 * This file is part of the CyclePath project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\DataFixtures\ORM;

use App\Models\Location;
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
        $location = new Location();

        $location->setTimestamp(100000);
        $location->setLatitude(300.56);
        $location->setLongitude(300.56);
        $location->setPath($this->getReference('path'));

        $location_II = new Location();

        $location_II->setTimestamp(300000);
        $location_II->setLatitude(354.56);
        $location_II->setLongitude(300.56);
        $location->setPath($this->getReference('path'));

        $location_III = new Location();

        $location_III->setTimestamp(400000);
        $location_III->setLatitude(324.56);
        $location_III->setLongitude(300.56);
        $location->setPath($this->getReference('path'));

        $location_IV = new Location();

        $location_IV->setTimestamp(2000000);
        $location_IV->setLatitude(400.56);
        $location_IV->setLongitude(300.56);
        $location->setPath($this->getReference('path'));

        $manager->persist($location);
        $manager->persist($location_II);
        $manager->persist($location_III);
        $manager->persist($location_IV);

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

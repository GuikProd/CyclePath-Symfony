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

use App\Models\Path;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class PathFixtures
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class PathFixtures extends Fixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $path = new Path();

        $path->setEndingDate(new \DateTime('2017-04-24'));
        $path->setDistance(3000.560);
        $path->setDuration('3 heures, 25 minutes et 43 secondes.');
        $path->setAltitude(100.25);

        $path_II = new Path();

        $path_II->setEndingDate(new \DateTime('2017-04-30'));
        $path_II->setDistance(3000.560);
        $path_II->setDuration('5 heures, 25 minutes et 43 secondes.');
        $path_II->setAltitude(100.25);

        $path_III = new Path();

        $path_III->setEndingDate(new \DateTime('2017-04-25'));
        $path_III->setDistance(3000.560);
        $path_III->setDuration('1 heures, 25 minutes et 43 secondes.');
        $path_III->setAltitude(100.25);

        $path_IV = new Path();

        $path_IV->setEndingDate(new \DateTime('2017-04-28'));
        $path_IV->setDistance(3000.560);
        $path_IV->setDuration('4 heures, 25 minutes et 43 secondes.');
        $path_IV->setAltitude(100.25);

        $manager->persist($path);
        $manager->persist($path_II);
        $manager->persist($path_III);
        $manager->persist($path_IV);

        $manager->flush();
    }
}

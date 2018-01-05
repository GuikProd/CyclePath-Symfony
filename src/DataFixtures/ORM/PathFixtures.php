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

use App\Builders\PathBuilder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class PathFixtures.
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
        $path = new PathBuilder();

        $path
            ->create()
            ->withStartingDate(new \DateTime())
            ->withEndingDate(new \DateTime('2017-04-24'))
            ->withDistance(3000.560)
            ->withDuration('3 heures, 25 minutes et 43 secondes.')
            ->withAltitude(100.25)
            ->withFavorite(true);

        $this->setReference('path', $path->build());

        $path_II = new PathBuilder();

        $path_II
            ->create()
            ->withStartingDate(new \DateTime())
            ->withEndingDate(new \DateTime('2017-04-30'))
            ->withDistance(3000.560)
            ->withDuration('5 heures, 25 minutes et 43 secondes.')
            ->withAltitude(100.25)
            ->withFavorite(true);

        $this->setReference('path_II', $path_II->build());

        $path_III = new PathBuilder();

        $path_III
            ->create()
            ->withStartingDate(new \DateTime())
            ->withEndingDate(new \DateTime('2017-04-25'))
            ->withDistance(3000.560)
            ->withDuration('1 heures, 25 minutes et 43 secondes.')
            ->withAltitude(100.25)
            ->withFavorite(true);

        $this->setReference('path_III', $path_III->build());

        $path_IV = new PathBuilder();

        $path_IV
            ->create()
            ->withStartingDate(new \DateTime())
            ->withEndingDate(new \DateTime('2017-04-28'))
            ->withDistance(3000.560)
            ->withDuration('4 heures, 25 minutes et 43 secondes.')
            ->withAltitude(100.25)
            ->withFavorite(true);

        $this->setReference('path_IV', $path_IV->build());

        $manager->persist($path->build());
        $manager->persist($path_II->build());
        $manager->persist($path_III->build());
        $manager->persist($path_IV->build());

        $manager->flush();
    }
}

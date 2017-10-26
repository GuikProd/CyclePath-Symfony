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

use App\Models\Badge;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class BadgeFixtures
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BadgeFixtures extends Fixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $badge = new Badge();

        $badge->setLabel('Best climber !');
        $badge->setLevel(4);
        $badge->addUser($this->getReference('user'));
        $badge->setImage($this->getReference('image'));

        $badge_II = new Badge();

        $badge_II->setLabel('Best runner !');
        $badge_II->setLevel(4);
        $badge_II->addUser($this->getReference('user'));
        $badge_II->setImage($this->getReference('image_II'));

        $badge_III = new Badge();

        $badge_III->setLabel('Best climber ever !');
        $badge_III->setLevel(4);
        $badge_III->addUser($this->getReference('user_II'));
        $badge_III->setImage($this->getReference('image_III'));

        $badge_IV = new Badge();

        $badge_IV->setLabel('Good beginner !');
        $badge_IV->setLevel(4);
        $badge_IV->addUser($this->getReference('user_IV'));
        $badge_IV->setImage($this->getReference('image_IV'));

        $manager->persist($badge);
        $manager->persist($badge_II);
        $manager->persist($badge_III);
        $manager->persist($badge_IV);

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            ImageFixtures::class
        ];
    }
}

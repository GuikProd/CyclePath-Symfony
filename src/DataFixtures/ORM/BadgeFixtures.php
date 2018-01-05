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

use App\Builders\BadgeBuilder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class BadgeFixtures.
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
        $badge = new BadgeBuilder();

        $badge
            ->create()
            ->withObtentionDate(new \DateTime())
            ->withLabel('Best climber !')
            ->withLevel(4)
            ->withUser($this->getReference('user'))
            ->withImage($this->getReference('image'));

        $badge_II = new BadgeBuilder();

        $badge_II
            ->create()
            ->withObtentionDate(new \DateTime())
            ->withLabel('Best runner !')
            ->withLevel(4)
            ->withUser($this->getReference('user'))
            ->withImage($this->getReference('image_II'));

        $badge_III = new BadgeBuilder();

        $badge_III
            ->create()
            ->withObtentionDate(new \DateTime())
            ->withLabel('Best climber ever !')
            ->withLevel(4)
            ->withUser($this->getReference('user_II'))
            ->withImage($this->getReference('image_III'));

        $badge_IV = new BadgeBuilder();

        $badge_IV
            ->create()
            ->withObtentionDate(new \DateTime())
            ->withLabel('Good beginner !')
            ->withLevel(4)
            ->withUser($this->getReference('user_IV'))
            ->withImage($this->getReference('image_IV'));

        $manager->persist($badge->build());
        $manager->persist($badge_II->build());
        $manager->persist($badge_III->build());
        $manager->persist($badge_IV->build());

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            ImageFixtures::class,
        ];
    }
}

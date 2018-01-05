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

use App\Builders\ImageBuilder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class ImageFixtures.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ImageFixtures extends Fixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $image = new ImageBuilder();

        $image
            ->create()
            ->withCreationDate(new \DateTime())
            ->withLabel('New Image !')
            ->withAlt('New Image !')
            ->withUrl('https://localhost/public/images/new_image.png')
            ->withUser($this->getReference('user'));

        $this->setReference('image', $image->build());

        $image_II = new ImageBuilder();

        $image_II
            ->create()
            ->withCreationDate(new \DateTime())
            ->withLabel('New Image II !')
            ->withAlt('New Image II !')
            ->withUrl('https://localhost/public/images/new_image_II.png')
            ->withUser($this->getReference('user_II'));

        $this->setReference('image_II', $image_II->build());

        $image_III = new ImageBuilder();

        $image_III
            ->create()
            ->withCreationDate(new \DateTime())
            ->withLabel('New Image III !')
            ->withAlt('New Image III !')
            ->withUrl('https://localhost/public/images/new_image_III.png')
            ->withUser($this->getReference('user_III'));

        $this->setReference('image_III', $image_III->build());

        $image_IV = new ImageBuilder();

        $image_IV
            ->create()
            ->withCreationDate(new \DateTime())
            ->withLabel('New Image IV !')
            ->withAlt('New Image IV !')
            ->withUrl('https://localhost/public/images/new_image_IV.png')
            ->withUser($this->getReference('user_IV'));

        $this->setReference('image_IV', $image_IV->build());

        $manager->persist($image->build());
        $manager->persist($image_II->build());
        $manager->persist($image_III->build());
        $manager->persist($image_IV->build());

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}

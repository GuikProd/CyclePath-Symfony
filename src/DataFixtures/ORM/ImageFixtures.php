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

use App\Models\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class ImageFixtures
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
        $image = new Image();

        $image->setLabel('New Image !');
        $image->setAlt('New Image !');
        $image->setUrl('https://localhost/public/images/new_image.png');

        $image_II = new Image();

        $image_II->setLabel('New Image II !');
        $image_II->setAlt('New Image II !');
        $image_II->setUrl('https://localhost/public/images/new_image_II.png');

        $image_III = new Image();

        $image_III->setLabel('New Image III !');
        $image_III->setAlt('New Image III !');
        $image_III->setUrl('https://localhost/public/images/new_image_III.png');

        $image_IV = new Image();

        $image_IV->setLabel('New Image IV !');
        $image_IV->setAlt('New Image IV !');
        $image_IV->setUrl('https://localhost/public/images/new_image_IV.png');

        $manager->persist($image);
        $manager->persist($image_II);
        $manager->persist($image_III);
        $manager->persist($image_IV);

        $manager->flush();
    }
}

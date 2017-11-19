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

use App\Models\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class UserFixtures
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserFixtures extends Fixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setFirstname('Harry');
        $user->setLastname('Potter');
        $user->setUsername('HP');
        $user->setEmail('hp@gmail.com');
        $user->setPlainPassword('Ie1FDLHHP');
        $user->addRole('ROLE_WIZARD');
        $user->setCreationDate(new \DateTime());
        $user->setValidationDate(new \Datetime('2017-04-24'));
        $user->setValidated(true);
        $user->setActive(false);
        $user->setApiToken('6a41d94d2a0d45a-41a5-d2ad4ad-d52a-d4ad');
        $user->setValidationToken(
            crypt(
                str_rot13(
                    str_shuffle(
                        $user->getEmail()
                    )
                ),
                $user->getUsername()
            )
        );

        $this->setReference('user', $user);

        $user_II = new User();

        $user_II->setFirstname('Tom');
        $user_II->setLastname('Potter');
        $user_II->setUsername('TP');
        $user_II->setEmail('tp@gmail.com');
        $user_II->setPlainPassword('Ie1FDLHTP');
        $user_II->addRole('ROLE_WIZARD');
        $user_II->setCreationDate(new \DateTime());
        $user_II->setValidationDate(new \Datetime('2017-04-26'));
        $user_II->setValidated(true);
        $user_II->setActive(false);
        $user_II->setApiToken('6a41d94d2a0d45a-41a5-d2ad4ad-d52a-d4BD');
        $user_II->setValidationToken(
            crypt(
                str_rot13(
                    str_shuffle(
                        $user_II->getEmail()
                    )
                ),
                $user_II->getUsername()
            )
        );
        $this->setReference('user_II', $user_II);

        $user_III = new User();

        $user_III->setFirstname('Lilly');
        $user_III->setLastname('Potter');
        $user_III->setUsername('LP');
        $user_III->setEmail('lp@gmail.com');
        $user_III->setPlainPassword('Ie1FDLHLP');
        $user_III->addRole('ROLE_WIZARD');
        $user_III->setCreationDate(new \DateTime());
        $user_III->setValidationDate(new \Datetime('2017-04-20'));
        $user_III->setValidated(true);
        $user_III->setActive(false);
        $user_III->setApiToken('6a41d94d2a0d45a-41a5-d2ad4ad-d52a-d4LD');
        $user_III->setValidationToken(
            crypt(
                str_rot13(
                    str_shuffle(
                        $user_III->getEmail()
                    )
                ),
                $user_III->getUsername()
            )
        );
        $this->setReference('user_III', $user_III);

        $user_IV = new User();

        $user_IV->setFirstname('Severus');
        $user_IV->setLastname('Potter');
        $user_IV->setUsername('SP');
        $user_IV->setEmail('sp@gmail.com');
        $user_IV->setPlainPassword('Ie1FDLHSP');
        $user_IV->addRole('ROLE_WIZARD');
        $user_IV->setCreationDate(new \DateTime());
        $user_IV->setValidationDate(new \Datetime('2017-04-12'));
        $user_IV->setValidated(true);
        $user_IV->setActive(false);
        $user_IV->setApiToken('6a41d94d2a0d45a-41a5-d2ad4ad-d52a-d4SP');
        $user_IV->setValidationToken(
            crypt(
                str_rot13(
                    str_shuffle(
                        $user_IV->getEmail()
                    )
                ),
                $user_IV->getUsername()
            )
        );
        $this->setReference('user_IV', $user_IV);

        $passwordEncoder = $this->container->get('security.password_encoder');

        $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);

        $password_II = $passwordEncoder->encodePassword($user_II, $user_II->getPlainPassword());
        $user_II->setPassword($password_II);

        $password_III = $passwordEncoder->encodePassword($user_III, $user_III->getPlainPassword());
        $user_III->setPassword($password_III);

        $password_IV = $passwordEncoder->encodePassword($user_IV, $user_IV->getPlainPassword());
        $user_IV->setPassword($password_IV);

        $manager->persist($user);
        $manager->persist($user_II);
        $manager->persist($user_III);
        $manager->persist($user_IV);

        $manager->flush();
    }
}

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

use App\Builders\UserBuilder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class UserFixtures.
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
        $user = new UserBuilder();

        $user
            ->create()
            ->withFirstname('Harry')
            ->withLastname('Potter')
            ->withUsername('HP')
            ->withEmail('hp@gmail.com')
            ->withPlainPassword('Ie1FDLHHP')
            ->withRole('ROLE_WIZARD')
            ->withCreationDate(new \DateTime())
            ->withValidationDate(new \Datetime('2017-04-24'))
            ->withValidated(true)
            ->withActive(false)
            ->withApiToken('6a41d94d2a0d45a-41a5-d2ad4ad-d52a-d4ad')
            ->withValidationToken(
                crypt(
                    str_rot13(
                        str_shuffle(
                            $user->build()->getEmail()
                        )
                    ),
                    $user->build()->getUsername()
                )
            );

        $this->setReference('user', $user->build());

        $user_II = new UserBuilder();

        $user_II
            ->create()
            ->withFirstname('Tom')
            ->withLastname('Potter')
            ->withUsername('TP')
            ->withEmail('tp@gmail.com')
            ->withPlainPassword('Ie1FDLHTP')
            ->withRole('ROLE_WIZARD')
            ->withCreationDate(new \DateTime())
            ->withValidationDate(new \Datetime('2017-04-26'))
            ->withValidated(true)
            ->withActive(false)
            ->withApiToken('6a41d94d2a0d45a-41a5-d2ad4ad-d52a-d4BD')
            ->withValidationToken(
                crypt(
                    str_rot13(
                        str_shuffle(
                            $user_II->build()->getEmail()
                        )
                    ),
                    $user_II->build()->getUsername()
                )
            );
        $this->setReference('user_II', $user_II->build());

        $user_III = new UserBuilder();

        $user_III
            ->create()
            ->withFirstname('Lilly')
            ->withLastname('Potter')
            ->withUsername('LP')
            ->withEmail('lp@gmail.com')
            ->withPlainPassword('Ie1FDLHLP')
            ->withRole('ROLE_WIZARD')
            ->withCreationDate(new \DateTime())
            ->withValidationDate(new \Datetime('2017-04-20'))
            ->withValidated(true)
            ->withActive(false)
            ->withApiToken('6a41d94d2a0d45a-41a5-d2ad4ad-d52a-d4LD')
            ->withValidationToken(
            crypt(
                str_rot13(
                    str_shuffle(
                        $user_III->build()->getEmail()
                    )
                ),
                $user_III->build()->getUsername()
            )
        );
        $this->setReference('user_III', $user_III->build());

        $user_IV = new UserBuilder();

        $user_IV
            ->create()
            ->withFirstname('Severus')
            ->withLastname('Potter')
            ->withUsername('SP')
            ->withEmail('sp@gmail.com')
            ->withPlainPassword('Ie1FDLHSP')
            ->withRole('ROLE_WIZARD')
            ->withCreationDate(new \DateTime())
            ->withValidationDate(new \Datetime('2017-04-12'))
            ->withValidated(true)
            ->withActive(false)
            ->withApiToken('6a41d94d2a0d45a-41a5-d2ad4ad-d52a-d4SP')
            ->withValidationToken(
            crypt(
                str_rot13(
                    str_shuffle(
                        $user_IV->build()->getEmail()
                    )
                ),
                $user_IV->build()->getUsername()
            )
        );
        $this->setReference('user_IV', $user_IV->build());

        $passwordEncoder = $this->container->get('security.password_encoder');

        $password = $passwordEncoder->encodePassword($user->build(), $user->build()->getPlainPassword());
        $user->withPassword($password);

        $password_II = $passwordEncoder->encodePassword($user_II->build(), $user_II->build()->getPlainPassword());
        $user_II->withPassword($password_II);

        $password_III = $passwordEncoder->encodePassword($user_III->build(), $user_III->build()->getPlainPassword());
        $user_III->withPassword($password_III);

        $password_IV = $passwordEncoder->encodePassword($user_IV->build(), $user_IV->build()->getPlainPassword());
        $user_IV->withPassword($password_IV);

        $manager->persist($user->build());
        $manager->persist($user_II->build());
        $manager->persist($user_III->build());
        $manager->persist($user_IV->build());

        $manager->flush();
    }
}

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

namespace App\Tests\Form\Type;

use App\Builders\UserBuilder;
use App\Form\Type\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\PreloadedExtension;

/**
 * Class RegisterTypeTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class RegisterTypeTest extends TypeTestCase
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->entityManagerInterface = $this->getMockBuilder(EntityManagerInterface::class)
                                             ->disableOriginalConstructor()
                                             ->getMock();

        parent::setUp();
    }

    /**
     * {@inheritdoc}
     */
    public function getExtensions()
    {
        $type = new RegisterType($this->entityManagerInterface);

        return [
            new PreloadedExtension([
                $type
            ], [])
        ];
    }

    public function testFormSubmission()
    {
        $user = new UserBuilder();
        $user
            ->create()
            ->withUsername("Toto")
            ->withEmail("toto@gmail.com")
            ->withPlainPassword("Ie1FDLTOTO")
        ;

        $form = $this->factory->create(RegisterType::class, $user->build());

        static::assertTrue(
            $form->isSynchronized()
        );

        static::assertEquals(
            $user->build(),
            $form->getData()
        );
    }
}

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

namespace App\Tests\Form;

use App\Form\Type\RegisterType;
use App\Models\Interfaces\UserInterface;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class RegisterTypeTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class RegisterTypeTest extends TypeTestCase
{
    public function testRegistrationSubmitProcess()
    {
        $userStub = $this->createMock(UserInterface::class);

        $registerForm = $this->factory->create(RegisterType::class);

        $registerForm->submit($userStub);

        static::assertTrue($registerForm->isSynchronized());
    }
}

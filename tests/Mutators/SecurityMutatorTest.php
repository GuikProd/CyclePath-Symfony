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

namespace App\Tests\Mutators;

use App\Models\Interfaces\UserInterface;
use App\Mutators\SecurityMutator;
use Overblog\GraphQLBundle\Definition\Argument;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class SecurityMutatorTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class SecurityMutatorTest extends KernelTestCase
{
    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        static::bootKernel();
    }

    public function testRegistration()
    {
        $arguments = $this->createMock(Argument::class);
        $arguments->method('getRawArguments')
                  ->willReturn([
                      'username' => 'Toto',
                      'email' => 'toto@gmail.com',
                      'plainPassword' => 'tototest'
                  ]);

        $mutator = $this->getMockBuilder(SecurityMutator::class)
                        ->setMethods(['register'])
                        ->getMock();

        $mutator->expects(static::once())
                ->method('register')
                ->with(static::equalTo($arguments));

        static::assertInstanceOf(UserInterface::class, $mutator->register($arguments));
    }
}

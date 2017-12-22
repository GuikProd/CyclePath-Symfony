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

namespace spec\App\Form\Type;

use PhpSpec\ObjectBehavior;
use App\Form\Type\ResetPasswordType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;

/**
 * Class ResetPasswordTypeSpec
 * 
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ResetPasswordTypeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldBeAnInstanceOf(ResetPasswordType::class);
    }

    public function it_should_be_a_subclass_of()
    {
        $this->shouldHaveType(AbstractType::class);
    }

    public function it_should_be_a_children_of()
    {
        $this->getParent()->shouldReturn(FormType::class);
    }
}

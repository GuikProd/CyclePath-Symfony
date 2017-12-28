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
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;

/**
 * Class RegisterTypeSpec.
 *
 * @author Guillaume Loulier
 */
class RegisterTypeSpec extends ObjectBehavior
{
    /**
     * @param EntityManagerInterface|\PhpSpec\Wrapper\Collaborator $entityManager
     */
    public function it_it_initializable(EntityManagerInterface $entityManager)
    {
        $this->beConstructedWith($entityManager);
        $this->shouldHaveType(AbstractType::class);
    }

    /**
     * @param EntityManagerInterface|\PhpSpec\Wrapper\Collaborator $entityManager
     */
    public function it_should_be_a_children_of(EntityManagerInterface $entityManager)
    {
        $this->beConstructedWith($entityManager);
        $this->getParent()->shouldReturn(FormType::class);
    }
}

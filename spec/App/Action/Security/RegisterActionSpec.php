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

namespace spec\App\Action\Security;

use Twig\Environment;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Form\FormFactoryInterface;
use App\Builders\Interfaces\UserBuilderInterface;
use App\Handler\Interfaces\RegisterHandlerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class RegisterActionSpec.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class RegisterActionSpec extends ObjectBehavior
{
    /**
     * @param \PhpSpec\Wrapper\Collaborator|Environment              $twig
     * @param UserBuilderInterface|\PhpSpec\Wrapper\Collaborator     $userBuilder
     * @param \PhpSpec\Wrapper\Collaborator|FormFactoryInterface     $formFactory
     * @param \PhpSpec\Wrapper\Collaborator|UrlGeneratorInterface    $urlGenerator
     * @param RegisterHandlerInterface|\PhpSpec\Wrapper\Collaborator $registerHandler
     * @param \PhpSpec\Wrapper\Collaborator|EventDispatcherInterface $eventDispatcher
     */
    public function it_is_initializable(
        Environment $twig,
        UserBuilderInterface $userBuilder,
        FormFactoryInterface $formFactory,
        UrlGeneratorInterface $urlGenerator,
        RegisterHandlerInterface $registerHandler,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->beConstructedWith($twig, $userBuilder, $urlGenerator, $formFactory, $registerHandler, $eventDispatcher);
    }
}

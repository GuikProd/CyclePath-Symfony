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

namespace App\Action\Security;

use Twig\Environment;
use App\Form\Type\RegisterType;
use App\Events\User\UserCreatedEvent;
use App\Responder\Security\RegisterResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormFactoryInterface;
use App\Builders\Interfaces\UserBuilderInterface;
use App\Handler\Interfaces\RegisterHandlerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

/**
 * Class RegisterAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class RegisterAction
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var UserBuilderInterface
     */
    private $userBuilder;

    /**
     * @var FlashBagInterface
     */
    private $flashBagInterface;

    /**
     * @var FormFactoryInterface
     */
    private $formFactoryInterface;

    /**
     * @var RegisterHandlerInterface
     */
    private $registerHandlerInterface;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcherInterface;

    /**
     * RegisterAction constructor.
     *
     * @param Environment $twig
     * @param UserBuilderInterface $userBuilder
     * @param FlashBagInterface $flashBagInterface
     * @param FormFactoryInterface $formFactoryInterface
     * @param RegisterHandlerInterface $registerHandlerInterface
     * @param EventDispatcherInterface $eventDispatcherInterface
     */
    public function __construct(
        Environment $twig,
        UserBuilderInterface $userBuilder,
        FlashBagInterface $flashBagInterface,
        FormFactoryInterface $formFactoryInterface,
        RegisterHandlerInterface $registerHandlerInterface,
        EventDispatcherInterface $eventDispatcherInterface
    ) {
        $this->twig = $twig;
        $this->userBuilder = $userBuilder;
        $this->flashBagInterface = $flashBagInterface;
        $this->formFactoryInterface = $formFactoryInterface;
        $this->registerHandlerInterface = $registerHandlerInterface;
        $this->eventDispatcherInterface = $eventDispatcherInterface;
    }

    /**
     * @param Request $request
     * @param RegisterResponder $responder
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, RegisterResponder $responder): Response
    {
        $this->userBuilder
             ->create()
             ->withCreationDate(new \DateTime())
             ->withActive(false)
             ->withValidated(false)
             ->withRole('ROLE_USER');

        $registerForm = $this->formFactoryInterface
                             ->create(RegisterType::class, $this->userBuilder->build());

        $response = $this->registerHandlerInterface
                         ->handle($registerForm, $this->userBuilder, $request);

        if ($response instanceof Response) {
            $userCreatedEvent = new UserCreatedEvent($this->userBuilder->build());
            $this->eventDispatcherInterface->dispatch(UserCreatedEvent::NAME, $userCreatedEvent);

            $this->flashBagInterface->add('success', 'Your account has been created !');

            return $response;
        }

        return $responder($registerForm->createView());
    }
}

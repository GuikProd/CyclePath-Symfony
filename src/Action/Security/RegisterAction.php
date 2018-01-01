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

use App\Form\Type\RegisterType;
use App\Events\User\UserCreatedEvent;
use App\Responder\Security\RegisterResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormFactoryInterface;
use App\Builders\Interfaces\UserBuilderInterface;
use App\Handler\Interfaces\RegisterHandlerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class RegisterAction.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class RegisterAction
{
    /**
     * @var UserBuilderInterface
     */
    private $userBuilder;

    /**
     * @var SessionInterface
     */
    private $sessionInterface;

    /**
     * @var FormFactoryInterface
     */
    private $formFactoryInterface;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGeneratorInterface;

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
     * @param UserBuilderInterface     $userBuilder
     * @param SessionInterface         $sessionInterface
     * @param FormFactoryInterface     $formFactoryInterface
     * @param UrlGeneratorInterface    $urlGeneratorInterface
     * @param RegisterHandlerInterface $registerHandlerInterface
     * @param EventDispatcherInterface $eventDispatcherInterface
     */
    public function __construct(
        UserBuilderInterface $userBuilder,
        SessionInterface $sessionInterface,
        FormFactoryInterface $formFactoryInterface,
        UrlGeneratorInterface $urlGeneratorInterface,
        RegisterHandlerInterface $registerHandlerInterface,
        EventDispatcherInterface $eventDispatcherInterface
    ) {
        $this->userBuilder = $userBuilder;
        $this->sessionInterface = $sessionInterface;
        $this->formFactoryInterface = $formFactoryInterface;
        $this->urlGeneratorInterface = $urlGeneratorInterface;
        $this->registerHandlerInterface = $registerHandlerInterface;
        $this->eventDispatcherInterface = $eventDispatcherInterface;
    }

    /**
     * @param Request $request
     * @param RegisterResponder $responder
     *
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, RegisterResponder $responder): Response
    {
        $this->userBuilder->create();

        $registerForm = $this->formFactoryInterface
                             ->create(RegisterType::class, $this->userBuilder->build())
                             ->handleRequest($request);

        if ($this->registerHandlerInterface->handle($registerForm, $this->userBuilder)) {
            $userCreatedEvent = new UserCreatedEvent($this->userBuilder->build());
            $this->eventDispatcherInterface->dispatch(UserCreatedEvent::NAME, $userCreatedEvent);

            $this->sessionInterface
                 ->getFlashBag()
                 ->add(
                    'success',
                    'Your account was created ! Please check your mail to validate it.'
                 );

            return new RedirectResponse(
                $this->urlGeneratorInterface->generate('index')
            );
        }

        return $responder($registerForm->createView());
    }
}

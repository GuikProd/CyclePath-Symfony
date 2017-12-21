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
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Form\FormFactoryInterface;
use App\Builders\Interfaces\UserBuilderInterface;
use App\Managers\Interfaces\UserManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
     * @var RouterInterface
     */
    private $routerInterface;

    /**
     * @var FlashBagInterface
     */
    private $flashBagInterface;

    /**
     * @var FormFactoryInterface
     */
    private $formFactoryInterface;

    /**
     * @var UserManagerInterface
     */
    private $userManagerInterface;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcherInterface;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoderInterface;

    /**
     * RegisterAction constructor.
     *
     * @param Environment $twig
     * @param UserBuilderInterface $userBuilder
     * @param RouterInterface $routerInterface
     * @param FlashBagInterface $flashBagInterface
     * @param FormFactoryInterface $formFactoryInterface
     * @param UserManagerInterface $userManagerInterface
     * @param EventDispatcherInterface $eventDispatcherInterface
     * @param UserPasswordEncoderInterface $passwordEncoderInterface
     */
    public function __construct(
        Environment $twig,
        UserBuilderInterface $userBuilder,
        RouterInterface $routerInterface,
        FlashBagInterface $flashBagInterface,
        FormFactoryInterface $formFactoryInterface,
        UserManagerInterface $userManagerInterface,
        EventDispatcherInterface $eventDispatcherInterface,
        UserPasswordEncoderInterface $passwordEncoderInterface
    ) {
        $this->twig = $twig;
        $this->userBuilder = $userBuilder;
        $this->routerInterface = $routerInterface;
        $this->flashBagInterface = $flashBagInterface;
        $this->formFactoryInterface = $formFactoryInterface;
        $this->userManagerInterface = $userManagerInterface;
        $this->eventDispatcherInterface = $eventDispatcherInterface;
        $this->passwordEncoderInterface = $passwordEncoderInterface;
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
    public function __invoke(Request $request, RegisterResponder $responder)
    {
        $this->userBuilder
             ->create()
             ->withCreationDate(new \DateTime())
             ->withActive(false)
             ->withValidated(false)
             ->withRole('ROLE_USER');

        $registerForm = $this->formFactoryInterface
                             ->create(RegisterType::class, $this->userBuilder->build())
                             ->handleRequest($request);

        if ($registerForm->isSubmitted() && $registerForm->isValid()) {
            $this->userBuilder
                 ->withValidationToken(
                     crypt(
                         str_rot13(
                             str_shuffle(
                                 $this->userBuilder->build()->getEmail()
                             )
                         ),
                         $this->userBuilder->build()->getUsername()
                     )
                 )
                 ->withPassword(
                     $this->passwordEncoderInterface
                          ->encodePassword(
                              $this->userBuilder->build(),
                              $this->userBuilder->build()->getPlainPassword()
                          )
                 );

            $this->userManagerInterface->save($this->userBuilder->build());

            $userCreatedEvent = new UserCreatedEvent($this->userBuilder->build());
            $this->eventDispatcherInterface->dispatch(UserCreatedEvent::NAME, $userCreatedEvent);

            $this->flashBagInterface->add('success', 'Your account has been created !');

            return new RedirectResponse(
                $this->routerInterface->generate('index')
            );
        }

        return $responder($registerForm->createView());
    }
}

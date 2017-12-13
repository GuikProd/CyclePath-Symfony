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
use Symfony\Component\Form\FormFactoryInterface;
use App\Builders\Interfaces\UserBuilderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

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
     * @var FormFactoryInterface
     */
    private $formFactoryInterface;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcherInterface;

    /**
     * RegisterAction constructor.
     * @param Environment $twig
     * @param UserBuilderInterface $userBuilder
     * @param FormFactoryInterface $formFactoryInterface
     * @param EventDispatcherInterface $eventDispatcherInterface
     */
    public function __construct(Environment $twig, UserBuilderInterface $userBuilder, FormFactoryInterface $formFactoryInterface, EventDispatcherInterface $eventDispatcherInterface)
    {
        $this->twig = $twig;
        $this->userBuilder = $userBuilder;
        $this->formFactoryInterface = $formFactoryInterface;
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
                 );

            $userCreatedEvent = new UserCreatedEvent($this->userBuilder->build());
            $this->eventDispatcherInterface->dispatch(UserCreatedEvent::NAME, $userCreatedEvent);

            return new RedirectResponse('/');
        }

        return $responder($registerForm->createView());
    }
}

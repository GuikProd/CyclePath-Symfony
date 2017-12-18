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

use App\Interactors\UserInteractor;
use App\Events\User\UserValidatedEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Builders\Interfaces\UserBuilderInterface;
use App\Responder\Security\ValidationTokenResponder;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class ValidationTokenAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class ValidationTokenAction
{
    /**
     * @var UserBuilderInterface
     */
    private $userBuilder;

    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcherInterface;

    /**
     * ValidationTokenAction constructor.
     *
     * @param UserBuilderInterface $userBuilder
     * @param EntityManagerInterface $entityManagerInterface
     * @param EventDispatcherInterface $eventDispatcherInterface
     */
    public function __construct(
        UserBuilderInterface $userBuilder,
        EntityManagerInterface $entityManagerInterface,
        EventDispatcherInterface $eventDispatcherInterface
    ) {
        $this->userBuilder = $userBuilder;
        $this->entityManagerInterface = $entityManagerInterface;
        $this->eventDispatcherInterface = $eventDispatcherInterface;
    }

    /**
     * @param Request $request
     * @param ValidationTokenResponder $responder
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, ValidationTokenResponder $responder)
    {
        $user = $this->entityManagerInterface
                     ->getRepository(UserInteractor::class)
                     ->findOneBy([
                         'Emails' => $request->attributes->get('userEmail'),
                         'validationToken' => $request->attributes->get('validationToken')
                     ]);

        if ($user) {
            $this->userBuilder
                 ->setUser($user)
                 ->withActive(true)
                 ->withValidated(true)
                 ->withValidationDate(new \DateTime())
                 ->build();

            $this->entityManagerInterface->flush();

            $userValidatedEvent = new UserValidatedEvent($this->userBuilder->build());
            $this->eventDispatcherInterface->dispatch(UserValidatedEvent::NAME, $userValidatedEvent);

            return $responder();
        }

        return $responder(
            'This user does not exist !'
        );
    }
}

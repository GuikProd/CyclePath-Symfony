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

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Builders\Interfaces\UserBuilderInterface;
use App\Handler\Interfaces\RegisterHandlerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class RegisterHandler
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class RegisterHandler implements RegisterHandlerInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGeneratorInterface;

    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoderInterface;

    /**
     * RegisterHandler constructor.
     *
     * @param UrlGeneratorInterface $urlGeneratorInterface
     * @param EntityManagerInterface $entityManagerInterface
     * @param UserPasswordEncoderInterface $passwordEncoderInterface
     */
    public function __construct(
        UrlGeneratorInterface $urlGeneratorInterface,
        EntityManagerInterface $entityManagerInterface,
        UserPasswordEncoderInterface $passwordEncoderInterface
    ) {
        $this->urlGeneratorInterface = $urlGeneratorInterface;
        $this->entityManagerInterface = $entityManagerInterface;
        $this->passwordEncoderInterface = $passwordEncoderInterface;
    }

    /**
     * @param FormInterface $registerType
     * @param UserBuilderInterface $userBuilder
     * @param Request $request
     *
     * @return null|RedirectResponse
     */
    public function handle(FormInterface $registerType, UserBuilderInterface $userBuilder, Request $request):? Response
    {
        $registerType->handleRequest($request);

        if ($registerType->isSubmitted() && $registerType->isValid()) {

            $userBuilder
                ->withValidationToken(
                    crypt(
                        str_rot13(
                            str_shuffle(
                                $userBuilder->build()->getEmail()
                            )
                        ),
                        $userBuilder->build()->getUsername()
                    )
                )
                ->withPassword(
                    $this->passwordEncoderInterface
                        ->encodePassword(
                            $userBuilder->build(),
                            $userBuilder->build()->getPlainPassword()
                        )
                );

            $this->entityManagerInterface->persist($userBuilder->build());
            $this->entityManagerInterface->flush();

            return new RedirectResponse(
                $this->urlGeneratorInterface->generate('index')
            );
        }

        return null;
    }
}

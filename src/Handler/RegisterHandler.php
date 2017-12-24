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
use App\Builders\Interfaces\UserBuilderInterface;
use App\Handler\Interfaces\RegisterHandlerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class RegisterHandler
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class RegisterHandler implements RegisterHandlerInterface
{
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
     * @param EntityManagerInterface $entityManagerInterface
     * @param UserPasswordEncoderInterface $passwordEncoderInterface
     */
    public function __construct(
        EntityManagerInterface $entityManagerInterface,
        UserPasswordEncoderInterface $passwordEncoderInterface
    ) {
        $this->entityManagerInterface = $entityManagerInterface;
        $this->passwordEncoderInterface = $passwordEncoderInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(FormInterface $registerType, UserBuilderInterface $userBuilder, Request $request): bool
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

            return true;
        }

        return false;
    }
}

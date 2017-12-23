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

namespace App\Handler\Interfaces;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Builders\Interfaces\UserBuilderInterface;

/**
 * Interface RegisterHandlerInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface RegisterHandlerInterface
{
    /**
     * @param FormInterface $form
     * @param UserBuilderInterface $userBuilder
     * @param Request $request
     *
     * @return null|Response
     */
    public function handle(FormInterface $form, UserBuilderInterface $userBuilder, Request $request):? Response;
}

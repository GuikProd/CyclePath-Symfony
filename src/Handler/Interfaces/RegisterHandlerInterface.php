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
     * @param FormInterface $form                  The RegisterType form.
     * @param UserBuilderInterface $userBuilder    The UserBuilder linked to this Form.
     * @param Request $request                     The Request which contain the data.
     *
     * @return null|Response                       A RedirectResponse is the Form is valid, null otherwise.
     */
    public function handle(FormInterface $form, UserBuilderInterface $userBuilder, Request $request):? Response;
}

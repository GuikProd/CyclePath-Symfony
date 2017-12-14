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

namespace App\Subscribers\Interfaces\Form;

use Symfony\Component\Form\FormEvent;

/**
 * Interface RegisterFormSubscriberInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface RegisterFormSubscriberInterface
{
    /**
     * @param FormEvent $event
     */
    public function onSubmit(FormEvent $event): void;
}

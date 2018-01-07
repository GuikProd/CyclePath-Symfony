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

namespace App\Subscribers\Interfaces\GraphQL;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

/**
 * Interface GraphQLSubscriberInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface GraphQLSubscriberInterface
{
    /**
     * @param GetResponseForExceptionEvent $exceptionEvent
     *
     * @return void
     */
    public function onKernelException(GetResponseForExceptionEvent $exceptionEvent): void;
}

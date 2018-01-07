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

namespace App\Subscribers\GraphQL;

use App\Exceptions\GraphQLException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Subscribers\Interfaces\GraphQL\GraphQLSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

/**
 * Class GraphQLSubscriber
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class GraphQLSubscriber implements EventSubscriberInterface, GraphQLSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function onKernelException(GetResponseForExceptionEvent $exceptionEvent): void
    {
        if ($exceptionEvent->getException() instanceof GraphQLException) {
            $response = new JsonResponse([
                "error" => [
                    'code' => JsonResponse::HTTP_BAD_REQUEST,
                    'message' => $exceptionEvent->getException()->getMessage()
                ]
            ], JsonResponse::HTTP_BAD_REQUEST);

            $response->send();
        }
    }
}

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

namespace App\Subscribers;

use App\Exceptions\GraphQLException;
use Symfony\Component\HttpKernel\KernelEvents;
use App\Loggers\Interfaces\CoreLoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use App\Subscribers\Interfaces\GraphQL\GraphQLKernelSubscriberInterface;

/**
 * Class GraphQLKernelSubscriber.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class GraphQLKernelSubscriber implements EventSubscriberInterface, GraphQLKernelSubscriberInterface
{
    /**
     * @var CoreLoggerInterface
     */
    private $coreLoggerInterface;

    /**
     * GraphQLKernelSubscriber constructor.
     *
     * @param CoreLoggerInterface $coreLoggerInterface
     */
    public function __construct(CoreLoggerInterface $coreLoggerInterface)
    {
        $this->coreLoggerInterface = $coreLoggerInterface;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelExceptionEvent',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function onKernelExceptionEvent(GetResponseForExceptionEvent $event): void
    {
        if ($event->getException() instanceof GraphQLException) {
            $response = new JsonResponse([
                'error' => [
                    'code' => JsonResponse::HTTP_BAD_REQUEST,
                    'message' => $event->getException()->getMessage(),
                ],
            ], JsonResponse::HTTP_BAD_REQUEST);

            $this->coreLoggerInterface->onSecurityLog(
                'An user has tried to log with bad credentials',
                1
            );

            $event->setResponse($response);
        }
    }
}

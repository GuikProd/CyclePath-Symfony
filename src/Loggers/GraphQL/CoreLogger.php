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

namespace App\Loggers\GraphQL;

use Psr\Log\LoggerInterface;
use App\Loggers\Interfaces\CoreLoggerInterface;

/**
 * Class CoreLogger.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class CoreLogger implements CoreLoggerInterface
{
    /**
     * @var LoggerInterface
     */
    private $loggerInterface;

    /**
     * CoreLogger constructor.
     *
     * @param LoggerInterface $loggerInterface
     */
    public function __construct(LoggerInterface $loggerInterface)
    {
        $this->loggerInterface = $loggerInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function onUserLog(string $message, int $priority): void
    {
        $this->loggerInterface->info(
            $message.', this user entry must be treated as a '.$priority.' priority.'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function onSecurityLog(string $message, int $priority): void
    {
        $this->loggerInterface->notice(
            $message.', this security entry must be treated as a '.$priority.' priority'
        );
    }
}

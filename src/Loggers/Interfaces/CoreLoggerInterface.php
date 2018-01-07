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

namespace App\Loggers\Interfaces;

/**
 * Interface CoreLoggerInterface.
 *
 * @author Guillaume Loulier <contact@guillaumeloulir.fr>
 */
interface CoreLoggerInterface
{
    /**
     * @param string $message
     * @param int    $priority
     */
    public function onUserLog(string $message, int $priority): void;

    /**
     * @param string $message
     * @param int    $priority
     */
    public function onSecurityLog(string $message, int $priority): void;
}

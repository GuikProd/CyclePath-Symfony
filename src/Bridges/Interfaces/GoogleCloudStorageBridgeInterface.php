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

namespace App\Bridges\Interfaces;

use Google\Cloud\Storage\StorageClient;

/**
 * Interface GoogleCloudStorageBridgeInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface GoogleCloudStorageBridgeInterface
{
    /**
     * @return GoogleCloudStorageBridgeInterface
     */
    public function open(): GoogleCloudStorageBridgeInterface;

    /**
     * @return GoogleCloudStorageBridgeInterface
     */
    public function close(): GoogleCloudStorageBridgeInterface;

    /**
     * @return StorageClient
     */
    public function getStorageClient(): StorageClient;
}

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

namespace App\CloudStorage\Interfaces;

use Google\Cloud\Storage\Bucket;
use Google\Cloud\Storage\StorageClient;

/**
 * Interface GoogleCloudStorageBridgeInterface.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface GoogleCloudStorageBridgeInterface
{
    /**
     * @return GoogleCloudStorageBridgeInterface
     */
    public function open(): self;

    /**
     * @return GoogleCloudStorageBridgeInterface
     */
    public function close(): self;

    /**
     * @param string $bucketName the name of the bucket
     *
     * @return Bucket the actual bucket
     */
    public function connect(string $bucketName): Bucket;

    /**
     * @return StorageClient
     */
    public function getStorageClient(): StorageClient;
}

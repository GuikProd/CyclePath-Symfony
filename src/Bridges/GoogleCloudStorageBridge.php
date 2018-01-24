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

namespace App\Bridges;

use Google\Cloud\Storage\StorageClient;
use App\Bridges\Interfaces\GoogleCloudStorageBridgeInterface;

/**
 * Class GoogleCloudStorageBridge
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class GoogleCloudStorageBridge implements GoogleCloudStorageBridgeInterface
{
    /**
     * @var StorageClient
     */
    private $storage;

    /**
     * {@inheritdoc}
     */
    public function open(): GoogleCloudStorageBridgeInterface
    {
        $this->storage = new StorageClient();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function close(): GoogleCloudStorageBridgeInterface
    {
        $this->storage = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStorageClient(): StorageClient
    {
        return $this->storage;
    }
}

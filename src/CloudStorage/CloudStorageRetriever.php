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

namespace App\CloudStorage;

use Psr\Http\Message\StreamInterface;
use App\CloudStorage\Interfaces\CloudStorageRetrieverInterface;
use App\CloudStorage\Interfaces\GoogleCloudStorageBridgeInterface;

/**
 * Class CloudStorageRetriever.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class CloudStorageRetriever implements CloudStorageRetrieverInterface
{
    /**
     * @var GoogleCloudStorageBridgeInterface
     */
    private $storageBridge;

    /**
     * CloudStorageRetriever constructor.
     *
     * @param GoogleCloudStorageBridgeInterface $storageBridge
     */
    public function __construct(GoogleCloudStorageBridgeInterface $storageBridge)
    {
        $this->storageBridge = $storageBridge;
    }

    /**
     * {@inheritdoc}
     */
    public function getElement(string $bucketName, string $fileName, string $filePath): StreamInterface
    {
        return $this->storageBridge
                    ->open()
                    ->connect($bucketName)
                    ->object($fileName)
                    ->downloadToFile($filePath);
    }

    /**
     * {@inheritdoc}
     */
    public function getElements(string $bucketName): \Iterator
    {
        return $this->storageBridge
                    ->open()
                    ->connect($bucketName)
                    ->objects();
    }
}

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

namespace App\Gateway;

use App\Gateway\Interfaces\CloudStorageGatewayInterface;
use App\Bridges\Interfaces\GoogleCloudStorageBridgeInterface;

/**
 * Class CloudStorageGateway
 * 
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class CloudStorageGateway implements CloudStorageGatewayInterface
{
    /**
     * @var GoogleCloudStorageBridgeInterface
     */
    private $bridge;

    /**
     * CloudStorageGateway constructor.
     *
     * @param GoogleCloudStorageBridgeInterface $bridge
     */
    public function __construct(GoogleCloudStorageBridgeInterface $bridge)
    {
        $this->bridge = $bridge;
    }

    /**
     * {@inheritdoc}
     */
    public function save(string $fileName, string $filePath): void
    {

    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $fileName, string $filePath): void
    {
        // TODO: Implement delete() method.
    }
}

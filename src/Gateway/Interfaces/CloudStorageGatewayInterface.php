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

namespace App\Gateway\Interfaces;

/**
 * Interface CloudStorageGatewayInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface CloudStorageGatewayInterface
{
    /**
     * @param string $fileName
     *
     * @param string $filePath
     */
    public function save(string $fileName, string $filePath): void;

    /**
     * @param string $fileName
     *
     * @param string $filePath
     */
    public function delete(string $fileName, string $filePath): void;
}

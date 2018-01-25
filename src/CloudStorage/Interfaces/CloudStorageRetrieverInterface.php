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

use Psr\Http\Message\StreamInterface;

/**
 * Interface CloudStorageRetrieverInterface.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface CloudStorageRetrieverInterface
{
    /**
     * Return a single element of a bucket.
     *
     * @param string $bucketName    The name of the bucket
     * @param string $fileName      The name of the file to retrieve
     * @param string $filePath      The path of the file to retrieve
     *
     * @return StreamInterface      The file as a StreamInterface
     */
    public function getElement(string $bucketName, string $fileName, string $filePath): StreamInterface;

    /**
     * Return all the elements of a bucket.
     *
     * @param string $bucketName    The name of the bucket
     *
     * @return \Iterator            The array of elements found
     */
    public function getElements(string $bucketName): \Iterator;
}

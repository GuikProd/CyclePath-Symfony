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

use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class BlackfireContext
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BlackfireContext implements Context
{
    /**
     * @var Response
     */
    private $response;

    /**
     * @var KernelInterface
     */
    private $kernelInterface;

    /**
     * BlackfireContext constructor.
     *
     * @param KernelInterface $kernelInterface
     */
    public function __construct(KernelInterface $kernelInterface)
    {
        $this->kernelInterface = $kernelInterface;
    }
}

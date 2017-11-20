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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class APIContext
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class APIContext implements Context
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var Response|null
     */
    private $response;

    /**
     * FeatureContext constructor.
     *
     * @param KernelInterface $kernel
     */
    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @param string $path    The path of the request.
     * @param string $method  The method linked to the request.
     *
     * @When i send a request to :path with :method method.
     */
    public function iSendARequestToWithMethod(string $path, string $method)
    {
        $this->response = $this->kernel->handle(Request::create($path, $method));
    }

    /**
     * @Then the response should be received
     */
    public function theResponseShouldBeReceived()
    {
        if ($this->response === null) {
            throw new \RuntimeException('No response received');
        }
    }

    /**
     * @param int $statusCode
     *
     * @throws Exception
     *
     * @Then the response status code should be :statusCode
     */
    public function theResponseStatusCodeShouldBe(int $statusCode)
    {
        if ($this->response->getStatusCode() !== $statusCode) {
            throw new \Exception(
                sprintf(
                    'Bad status code ! Found %d',
                    $this->response->getStatusCode()
                )
            );
        }
    }
}

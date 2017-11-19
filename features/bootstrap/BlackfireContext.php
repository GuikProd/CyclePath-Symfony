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

use Blackfire\Probe;
use Blackfire\Client;
use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class BlackfireContext
 *
 * @author Guillaume Loulier <contact@guillaume.loulier.fr>
 */
class BlackfireContext implements Context
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
     * @var Probe
     */
    private $blackfireProbe;

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
     * @param string $path
     * @param string $method
     *
     * @When i send a request to :path with :method method and Blackfire enabled
     */
    public function iSendARequestToWithMethodAndBlackfireEnabled(string $path, string $method)
    {
        //$blackfire = new Client();

        //$this->blackfireProbe = $blackfire->createProbe();

        $this->response = $this->kernel->handle(Request::create($path, $method));

        //$blackfire->endProbe($this->blackfireProbe);
    }

    /**
     * @param int $statusCode    The status code needed.
     *
     * @throws Exception         If no response is received.
     *
     * @Then the response should be received and the status code should be :statusCode
     */
    public function theResponseShouldBeReceivedAndTheStatusCodeShouldBe(int $statusCode)
    {
        if ($this->response === null || $this->response->getStatusCode() !== $statusCode) {
            throw new \Exception(
                sprintf(
                    'No response received or bad status code found, actual status code %d',
                    $this->response->getStatusCode()
                )
            );
        }
    }
}

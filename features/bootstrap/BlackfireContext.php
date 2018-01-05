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

/**
 * Class BlackfireContext
 * 
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BlackfireContext implements Context
{
    /**
     * @var \Blackfire\Probe
     */
    private $probe;

    /**
     * @var \Blackfire\Client
     */
    private $client;

    /**
     * @When I start a new Probe
     */
    public function iStartANewProbe()
    {
        $this->client = new \Blackfire\Client();

        $this->probe = $this->client->createProbe();
    }

    /**
     * @Then I stop the Probe
     */
    public function iStopTheProbe()
    {
        $this->client->endProbe($this->probe);
    }
}

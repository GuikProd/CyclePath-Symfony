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

namespace App\Tests\Action\Security;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class ResetPasswordActionTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ResetPasswordActionTest extends WebTestCase
{
    /**
     * @var Client
     */
    private $client;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testStatusCode()
    {
    }
}

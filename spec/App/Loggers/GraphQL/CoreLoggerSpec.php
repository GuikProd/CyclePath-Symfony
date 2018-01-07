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

namespace spec\App\Loggers\GraphQL;

use PhpSpec\ObjectBehavior;
use Psr\Log\LoggerInterface;
use App\Loggers\Interfaces\CoreLoggerInterface;

/**
 * Class CoreLoggerSpec.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class CoreLoggerSpec extends ObjectBehavior
{
    /**
     * @param \PhpSpec\Wrapper\Collaborator|LoggerInterface $logger
     */
    public function it_is_initializable(LoggerInterface $logger)
    {
        $this->beConstructedWith($logger);
        $this->beAnInstanceOf(CoreLoggerInterface::class);
    }
}

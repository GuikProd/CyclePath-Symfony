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

namespace spec\App\Subscribers\Security;

use Twig\Environment;
use PhpSpec\ObjectBehavior;
use App\Loggers\Interfaces\CoreLoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Subscribers\Interfaces\Security\CoreSecuritySubscriberInterface;

/**
 * Class CoreSecuritySubscriberSpec.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class CoreSecuritySubscriberSpec extends ObjectBehavior
{
    /**
     * @param \PhpSpec\Wrapper\Collaborator|Environment         $environment
     * @param \PhpSpec\Wrapper\Collaborator|\Swift_Mailer       $mailer
     * @param CoreLoggerInterface|\PhpSpec\Wrapper\Collaborator $logger
     */
    public function it_is_initializable(
        Environment $environment,
        \Swift_Mailer $mailer,
        CoreLoggerInterface $logger
    ) {
        $this->beConstructedWith($environment, $mailer, $logger);
    }

    /**
     * @param \PhpSpec\Wrapper\Collaborator|Environment         $environment
     * @param \PhpSpec\Wrapper\Collaborator|\Swift_Mailer       $mailer
     * @param CoreLoggerInterface|\PhpSpec\Wrapper\Collaborator $logger
     */
    public function it_should_implement(
        Environment $environment,
        \Swift_Mailer $mailer,
        CoreLoggerInterface $logger
    ) {
        $this->beConstructedWith($environment, $mailer, $logger);
        $this->shouldImplement(EventSubscriberInterface::class);
        $this->shouldImplement(CoreSecuritySubscriberInterface::class);
    }
}

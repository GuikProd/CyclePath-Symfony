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

use App\Builders\UserBuilder;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class DatabaseContext
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class DatabaseContext implements Context
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var RegistryInterface
     */
    private $doctrine;

    /**
     * @var SchemaTool
     */
    private $schemaTool;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * DatabaseContext constructor.
     *
     * @param RegistryInterface            $doctrine
     * @param KernelInterface              $kernel
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(RegistryInterface $doctrine, KernelInterface $kernel, UserPasswordEncoderInterface $encoder)
    {
        $this->doctrine = $doctrine;
        $this->kernel = $kernel;
        $this->schemaTool = new SchemaTool($this->doctrine->getManager());
        $this->passwordEncoder = $encoder;
    }
    /**
     * @BeforeScenario
     *
     * @throws \Doctrine\ORM\Tools\ToolsException
     */
    public function clearDatabase()
    {
        $this->schemaTool->dropSchema($this->doctrine->getManager()->getMetadataFactory()->getAllMetadata());
        $this->schemaTool->createSchema($this->doctrine->getManager()->getMetadataFactory()->getAllMetadata());
    }

    /**
     * Launch Doctrine fixtures command
     *
     * @param TableNode $users
     *
     * @Given /^I load following users:$/
     *
     * @throws Exception
     */
    public function iLoadFollowingUsers(TableNode $users)
    {
        foreach ($users->getHash() as $hash) {

            $user = new UserBuilder();
            $user
                ->create()
                ->withFirstname($hash['firstname'])
                ->withLastname($hash['lastname'])
                ->withUsername($hash['username'])
                ->withEmail($hash['email'])
                ->withPlainPassword($hash['plainPassword'])
                ->withPassword(
                    $this->passwordEncoder->encodePassword(
                        $user->build(),
                        $user->build()->getPlainPassword()
                    )
                )
                ->withRole('ROLE_USER')
                ->withActive($hash['active'])
                ->withValidated($hash['validated'])
                ->withValidationToken($hash['validationToken'])
                ->withCreationDate(new \DateTime());

            $this->doctrine->getManager()->persist($user->build());
        }

        $this->doctrine->getManager()->flush();
    }
}

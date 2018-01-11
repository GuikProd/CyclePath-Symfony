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

namespace App\DependencyInjection;

use App\Mutators\BadgeMutator;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Finder\Finder;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Class GraphQLServicePass
 *
 * @author Guillaume Loulier <contact@uillaumeloulier.fr>
 */
class GraphQLServicePass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $finder = new Finder();
        $yamlParser = new Yaml();

        $files = $finder->files()->in(
            $container->getParameter('kernel.project_dir').'/config/resolvers'
        );

        foreach ($files as $file) {
            switch ($file->getFilename()) {
                case 'resolvers.yaml':
                    $content = $yamlParser::parseFile($file);
                    foreach ($content as $item => $value) {
                        foreach ($value as $resolver) {
                            foreach ($container->getDefinitions() as $service) {
                                switch ($service->getClass()) {
                                    case !$resolver:
                                        throw new \LogicException(
                                            \sprintf(
                                                'The Resolvers must respect the convention, please check your .yaml file !'
                                            )
                                        );
                                        break;
                                    default:
                                        $container->register(substr($resolver, 14), $service->getClass())
                                                  ->setPrivate(true)
                                                  ->setAutowired(true)
                                                  ->addTag('overblog_graphql.resolver');
                                        break;
                                }
                            }
                        }
                    }
                    break;
                case 'mutators.yaml':
                    $content = $yamlParser::parseFile($file);
                    foreach ($content as $item => $value) {
                        foreach ($value as $mutator) {
                            foreach ($container->getDefinitions() as $service) {
                                switch ($service->getClass()) {
                                    case !$mutator:
                                        throw new \LogicException(
                                            \sprintf(
                                                'The Mutators must respect the convention, please check your .yaml file !'
                                            )
                                        );
                                        break;
                                    default:
                                        $container->register(substr($mutator, 14), $service->getClass())
                                                  ->setPrivate(true)
                                                  ->setAutowired(true)
                                                  ->addTag('overblog_graphql.mutation');
                                        break;
                                }
                            }
                        }
                    }
                    break;
                default:
                    throw new \LogicException(
                        \sprintf(
                            'Looks like your files isn\'t valid, be sure to respect the conventions !'
                        )
                    );
                    break;
            }
        }
    }
}

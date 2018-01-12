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

        $files = $finder->files()->in(
            $container->getParameter('kernel.project_dir').'/config/core'
        );

        foreach ($files as $file) {
            switch ($file->getFilename()) {
                case 'mutators.yaml':
                    foreach (Yaml::parseFile($file) as $content) {
                        foreach ($content as $mutator) {
                            if ($container->has($mutator)) {
                                $container->register(substr($mutator, 13), $mutator)
                                          ->setAutowired(true)
                                          ->setPrivate(true)
                                          ->addTag('overblog_graphql.mutation');
                            } else {
                                throw new \LogicException(
                                    \sprintf(
                                        'The Mutators must be clearly defined, please check your files !'
                                    )
                                );
                            }
                        }
                    }
                    break;
                case 'resolvers.yaml':
                    foreach (Yaml::parseFile($file) as $content) {
                        foreach ($content as $resolver) {
                            if ($container->has($resolver)) {
                                $container->register(substr($resolver, 14), $resolver)
                                          ->setAutowired(true)
                                          ->setPrivate(true)
                                          ->addTag('overblog_graphql.resolver');
                            } else {
                                throw new \LogicException(
                                    \sprintf(
                                        'The Resolvers must be clearly defined, please check your files !'
                                    )
                                );
                            }
                        }
                    }
                    break;
                default:
                    throw new \LogicException(
                        \sprintf(
                            'The filename must respect the conventions ! Given %s', $file->getFilename()
                        )
                    );
                    break;
            }
        }
    }
}

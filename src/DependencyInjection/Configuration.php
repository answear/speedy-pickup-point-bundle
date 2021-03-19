<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('answear_speedy');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('username')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('password')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('language')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('clientSystemId')->defaultNull()->end()
            ->end();

        return $treeBuilder;
    }
}

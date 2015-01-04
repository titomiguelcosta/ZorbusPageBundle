<?php

namespace Zorbus\PageBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface {

    public function getConfigTreeBuilder() {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('zorbus_page');

        $rootNode
                ->children()
                    ->arrayNode('entities')
                        ->isRequired()
                        ->children()
                            ->scalarNode('page')
                                ->cannotBeEmpty()
                                ->isRequired()
                            ->end()
                            ->scalarNode('page_block')
                                ->cannotBeEmpty()
                                ->isRequired()
                            ->end()
                            ->scalarNode('block')
                                ->cannotBeEmpty()
                                ->isRequired()
                            ->end()
                        ->end()
                    ->end()
                ->end();
        
        
        return $treeBuilder;
    }

}

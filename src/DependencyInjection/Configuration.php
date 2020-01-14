<?php

namespace SfadlessCMF\ContentBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * BlockTypesConfiguration
 *
 * @author Pavel Golikov <pavel@golikov.tech>
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('sfadless_cmf_content');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('foo')
            ->end()
        ;

        return $treeBuilder;
    }
}

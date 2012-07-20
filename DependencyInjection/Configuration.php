<?php

namespace IB\MediaProxyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ib_media_proxy');

        $rootNode
            ->children()
                ->scalarNode('algorithm')->defaultValue('sha1')->end()
                ->scalarNode('secret')->defaultValue('ThisIsNotSecretChangeIt')->end()
                ->scalarNode('ignore_https')->defaultValue(false)->end()
                ->scalarNode('prefix_path')->defaultValue('')->end()
            ->end()
        ;
        return $treeBuilder;
    }
}

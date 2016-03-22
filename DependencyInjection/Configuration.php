<?php

namespace IDCI\Bundle\AwsSesBundle\DependencyInjection;

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
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('aws_ses');

        $rootNode
            ->children()
                ->scalarNode('access_key')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('secret_key')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('region_endpoint')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('message_from')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->arrayNode('message_to')
                    ->beforeNormalization()
                        ->ifString()
                        ->then(function ($v) { return array($v); })
                    ->end()
                    ->prototype('scalar')->end()
                    ->defaultValue(array())
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}

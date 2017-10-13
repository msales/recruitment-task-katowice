<?php

namespace Recruitment\ApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('api');
        $rootNode
            ->children()
                ->scalarNode('advertiser_offers_url')->end()
                ->arrayNode('allowed_fields')
                    ->children()
                        ->scalarNode('advertiser_id')->end()
                        ->scalarNode('payout_amount')->end()
                        ->scalarNode('payout_currency')->end()
                        ->scalarNode('name')->end()
                        ->scalarNode('countries')->end()
                        ->scalarNode('campaign_id')->end()
                        ->scalarNode('mobile_platform')->end()
                        ->arrayNode('app_details')
                            ->children()
                                ->scalarNode('platform')->end()
                                ->scalarNode('bundle_id')->end()
                            ->end()
                        ->end()
                        ->arrayNode('campaigns')
                            ->children()
                                ->scalarNode('countries')->end()
                                ->scalarNode('points')->end()
                                ->scalarNode('cid')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('points_rate')->end()
            ->end()
        ;
        return $treeBuilder;
    }
}
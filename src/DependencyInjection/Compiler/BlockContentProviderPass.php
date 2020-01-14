<?php

namespace SfadlessCMF\ContentBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * BlockContentProviderPass
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class BlockContentProviderPass implements CompilerPassInterface
{
    const BLOCK_CONTENT_PROVIDER_TAG = 'sfadless.cmf.block.content_provider';

    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('sfadless_cmf.content.content_provider');
        $services = $container->findTaggedServiceIds(static::BLOCK_CONTENT_PROVIDER_TAG);

        foreach ($services as $service => $tags) {
            foreach ($tags as $tag) {
                $definition->addMethodCall('add', [new Reference($service), $tag['code']]);
            }
        }
    }
}

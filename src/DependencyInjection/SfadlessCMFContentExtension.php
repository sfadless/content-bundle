<?php

namespace SfadlessCMF\ContentBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * ContentExtension
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class SfadlessCMFContentExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $blockTypesConfig = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('blocks.yaml');
        $loader->load('services.yaml');
        $loader->load('admin.yaml');
    }
}

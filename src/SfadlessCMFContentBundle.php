<?php

namespace SfadlessCMF\ContentBundle;

use SfadlessCMF\ContentBundle\DependencyInjection\Compiler\BlockContentProviderPass;
use SfadlessCMF\ContentBundle\DependencyInjection\Compiler\ReplaceServicesPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * ContentBundle
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class SfadlessCMFContentBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ReplaceServicesPass());
        $container->addCompilerPass(new BlockContentProviderPass());
    }
}

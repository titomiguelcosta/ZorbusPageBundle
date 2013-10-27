<?php

namespace Zorbus\PageBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class PageThemeCompilerPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container) {
        if (!$container->hasDefinition('zorbus.page.theme.compiler.config')) {
            return;
        }

        $definition = $container->getDefinition('zorbus.page.theme.compiler.config');

        $taggedServices = $container->findTaggedServiceIds('zorbus.page.theme');

        foreach ($taggedServices as $id => $attributes) {
            $definition->addMethodCall('addTheme', array(new Reference($id)));
        }
    }

}

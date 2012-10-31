<?php

namespace Zorbus\PageBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class PageThemeCompilerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('zorbus_page.compiler.page_themes.config'))
        {
            return;
        }

        $definition = $container->getDefinition(
                'zorbus_page.compiler.page_themes.config'
        );

        $taggedServices = $container->findTaggedServiceIds(
                'zorbus_page.theme'
        );
        foreach ($taggedServices as $id => $attributes)
        {
            $definition->addMethodCall(
                'addPageTheme', array(new Reference($id))
            );
        }
    }

}
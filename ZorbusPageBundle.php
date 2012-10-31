<?php

namespace Zorbus\PageBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Zorbus\PageBundle\DependencyInjection\Compiler\PageThemeCompilerPass;

class ZorbusPageBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new PageThemeCompilerPass());
    }

}

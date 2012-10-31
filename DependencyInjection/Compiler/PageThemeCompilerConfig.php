<?php

namespace Zorbus\PageBundle\DependencyInjection\Compiler;

use Zorbus\PageBundle\Model\PageThemeConfig;

class PageThemeCompilerConfig
{

    protected $pages = array();

    public function addPageTheme(PageThemeConfig $object)
    {
        $this->pages[] = $object;
    }

    public function getPages()
    {
        return $this->pages;
    }

}
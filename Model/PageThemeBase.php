<?php

namespace Zorbus\PageBundle\Model;

class PageThemeBase extends PageThemeConfig {
    public function getService()
    {
        return array(
            'zorbus_page.page_theme.base' => 'Base theme'
        );
    }
    public function getBlocks()
    {
        return array(
            'left' => 'Left',
            'right' => 'Right',
            'footer' => 'Footer'
        );
    }
    public function getTemplate()
    {
        return 'ZorbusPageBundle::page.html.twig';
    }
}
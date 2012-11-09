<?php

namespace Zorbus\PageBundle\Model;

class PageThemeTwo extends PageThemeConfig
{

    public function getService()
    {
        return array(
            'zorbus_page.page_theme.two' => 'Two column'
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
        return 'ZorbusPageBundle::two.html.twig';
    }

}
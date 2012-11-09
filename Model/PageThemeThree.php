<?php

namespace Zorbus\PageBundle\Model;

class PageThemeThree extends PageThemeConfig
{

    public function getService()
    {
        return array(
            'zorbus_page.page_theme.three' => 'Three column'
        );
    }

    public function getBlocks()
    {
        return array(
            'header' => 'Header',
            'left' => 'Left',
            'middle' => 'Center',
            'right' => 'Right',
            'footer' => 'Footer'
        );
    }

    public function getTemplate()
    {
        return 'ZorbusPageBundle::three.html.twig';
    }

}
<?php

namespace Zorbus\PageBundle\Theme;


class ThreeColumnTheme implements PageThemeInterface
{
    protected $enabled;

    public function __construct($enabled)
    {
        $this->enabled = (boolean) $enabled;
    }

    public function getService()
    {
        return 'zorbus.page.theme.three_column';
    }

    public function getName()
    {
        return 'Three column theme';
    }

    public function getSlots()
    {
        return array(
            'header' => 'Header',
            'left' => 'Left',
            'middle' => 'Center',
            'right' => 'Right',
            'footer' => 'Footer',
        );
    }

    public function getTemplate()
    {
        return 'ZorbusPageBundle:Theme:threeColumns.html.twig';
    }

    public function isEnabled()
    {
        return $this->enabled;
    }
}

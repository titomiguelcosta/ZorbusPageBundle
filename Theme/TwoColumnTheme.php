<?php

namespace Zorbus\PageBundle\Theme;


class TwoColumnTheme implements PageThemeInterface
{
    protected $enabled;

    public function __construct($enabled)
    {
        $this->enabled = (boolean) $enabled;
    }

    public function getService()
    {
        return 'zorbus.page.theme.two_column';
    }

    public function getName()
    {
        return 'Two column theme';
    }

    public function getSlots()
    {
        return array(
            'left' => 'Left',
            'right' => 'Right',
            'footer' => 'Footer',
        );
    }

    public function getTemplate()
    {
        return 'ZorbusPageBundle:Theme:twoColumns.html.twig';
    }

    public function isEnabled()
    {
        return $this->enabled;
    }
}

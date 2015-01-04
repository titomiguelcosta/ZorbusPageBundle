<?php

namespace Zorbus\PageBundle\DependencyInjection\Compiler;

use Zorbus\PageBundle\Theme\PageThemeInterface;

class PageThemeCompilerConfig
{
    protected $themes = array();

    public function addTheme($theme)
    {
        if ($theme instanceof PageThemeInterface && $theme->isEnabled()) {
            $this->themes[] = $theme;
        }
    }

    public function getThemes()
    {
        return $this->themes;
    }
}

<?php

namespace Zorbus\PageBundle\Model;

abstract class PageThemeConfig
{
    protected $javascripts = array();
    protected $stylesheets = array();

    abstract public function getService();

    abstract public function getBlocks();

    abstract public function getTemplate();

    public function addJavascript($file)
    {
        $this->javascripts[md5($file)] = (string) $file;
    }

    public function addStylesheet($file)
    {
        $this->stylesheets[md5($file)] = (string) $file;
    }

    public function getJavascripts()
    {
        return $this->javascripts;
    }

    public function getStylesheets()
    {
        return $this->stylesheets;
    }

}

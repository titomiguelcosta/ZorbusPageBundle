<?php

namespace Zorbus\PageBundle\Model;

abstract class PageThemeConfig
{

    abstract public function getService();

    abstract public function getBlocks();

    abstract public function getTemplate();
}

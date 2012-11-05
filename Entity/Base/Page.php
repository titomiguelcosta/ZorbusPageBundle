<?php

namespace Zorbus\PageBundle\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zorbus\PageBundle\Entity\Base\Page
 */
abstract class Page
{

    protected $redirect = null;

    public function __toString()
    {
        return $this->getTitle();
    }

    public function setRedirect($url)
    {
        $this->redirect = $url;
    }

    public function getRedirect()
    {
        return $this->redirect;
    }

    public function isRedirect()
    {
        return null !== $this->redirect;
    }

}
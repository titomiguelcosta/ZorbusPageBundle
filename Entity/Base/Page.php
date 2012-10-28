<?php

namespace Zorbus\PageBundle\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zorbus\PageBundle\Entity\Base\Page
 */
abstract class Page
{

    public function __toString()
    {
        return $this->getTitle();
    }

}
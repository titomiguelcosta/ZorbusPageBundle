<?php

namespace Zorbus\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zorbus\PageBundle\Entity\PageBlock
 */
class PageBlock extends Base\PageBlock
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var integer $position
     */
    private $position;

    /**
     * @var string $location
     */
    private $location;

    /**
     * @var boolean $is_enabled
     */
    private $enabled;

    /**
     * @var Zorbus\PageBundle\Entity\Page
     */
    private $page;

    /**
     * @var Zorbus\BlockBundle\Entity\Block
     */
    private $block;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return PageBlock
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return PageBlock
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set is_enabled
     *
     * @param boolean $isEnabled
     * @return PageBlock
     */
    public function setEnabled($isEnabled)
    {
        $this->is_enabled = $isEnabled;

        return $this;
    }

    /**
     * Get is_enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->is_enabled;
    }

    /**
     * Set page
     *
     * @param Zorbus\PageBundle\Entity\Page $page
     * @return PageBlock
     */
    public function setPage(\Zorbus\PageBundle\Entity\Page $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return Zorbus\PageBundle\Entity\Page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set block
     *
     * @param Zorbus\BlockBundle\Entity\Block $block
     * @return PageBlock
     */
    public function setBlock(\Zorbus\BlockBundle\Entity\Block $block = null)
    {
        $this->block = $block;

        return $this;
    }

    /**
     * Get block
     *
     * @return Zorbus\BlockBundle\Entity\Block
     */
    public function getBlock()
    {
        return $this->block;
    }
}
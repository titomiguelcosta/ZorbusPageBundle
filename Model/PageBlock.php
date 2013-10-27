<?php

namespace Zorbus\PageBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Zorbus\PageBundle\Model\PageInterface;
use Zorbus\PageBundle\Model\PageBlockInterface;
use Zorbus\BlockBundle\Model\BlockInterface;

/**
 * @ORM\MappedSuperclass
 */
abstract class PageBlock implements PageBlockInterface {

    /**
     * @ORM\ManyToOne(targetEntity="Zorbus\PageBundle\Model\PageInterface", inversedBy="pageBlocks")
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id")
     * @Gedmo\SortableGroup
     */
    protected $page;

    /**
     * @ORM\ManyToOne(targetEntity="Zorbus\BlockBundle\Model\BlockInterface")
     * @ORM\JoinColumn(name="block_id", referencedColumnName="id")
     */
    protected $block;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Gedmo\SortablePosition
     */
    protected $position;

    /**
     * @ORM\Column(type="string", length=255)
     * @Gedmo\SortableGroup
     */
    protected $slot;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $enabled;

    public function getId() {
        return $this->id;
    }

    public function setPosition($position) {
        $this->position = (integer) $position;

        return $this;
    }

    public function getPosition() {
        return $this->position;
    }

    public function setSlot($slot) {
        $this->slot = $slot;

        return $this;
    }

    public function getSlot() {
        return $this->slot;
    }

    public function setEnabled($enabled) {
        $this->enabled = $enabled;

        return $this;
    }

    public function getEnabled() {
        return $this->enabled;
    }

    public function setPage(PageInterface $page) {
        $this->page = $page;

        return $this;
    }

    public function getPage() {
        return $this->page;
    }

    public function setBlock(BlockInterface $block) {
        $this->block = $block;

        return $this;
    }

    public function getBlock() {
        return $this->block;
    }

}

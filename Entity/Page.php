<?php

namespace Zorbus\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zorbus\PageBundle\Entity\Page
 */
class Page extends Base\Page
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var string $subtitle
     */
    private $subtitle;

    /**
     * @var string $lang
     */
    private $lang;

    /**
     * @var string $slug
     */
    private $slug;

    /**
     * @var string $url
     */
    private $url;

    /**
     * @var string $theme
     */
    private $theme;

    /**
     * @var integer $lft
     */
    private $lft;

    /**
     * @var integer $rgt
     */
    private $rgt;

    /**
     * @var integer $root
     */
    private $root;

    /**
     * @var integer $lvl
     */
    private $lvl;

    /**
     * @var integer $user_id
     */
    private $user_id;

    /**
     * @var boolean $is_enabled
     */
    private $enabled;

    /**
     * @var \DateTime $created_at
     */
    private $created_at;

    /**
     * @var \DateTime $updated_at
     */
    private $updated_at;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $children;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $page_blocks;

    /**
     * @var Zorbus\PageBundle\Entity\Page
     */
    private $parent;

    /**
     * @var string $search
     */
    private $search;
    
    /**
     * @var string $seo_description
     */
    private $seo_description;

    /**
     * @var string $seo_keywords
     */
    private $seo_keywords;

    /**
     * @var integer $cache_ttl
     */
    private $cache_ttl;

    /**
     * @var string
     */
    private $redirect;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->page_blocks = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set title
     *
     * @param string $title
     * @return Page
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subtitle
     *
     * @param string $subtitle
     * @return Page
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set lang
     *
     * @param string $lang
     * @return Page
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Page
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Page
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set theme
     *
     * @param string $theme
     * @return Page
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set lft
     *
     * @param integer $lft
     * @return Page
     */
    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get lft
     *
     * @return integer
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     * @return Page
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set root
     *
     * @param integer $root
     * @return Page
     */
    public function setRoot($root)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Get root
     *
     * @return integer
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     * @return Page
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set user_id
     *
     * @param integer $userId
     * @return Page
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set is_enabled
     *
     * @param boolean $isEnabled
     * @return Page
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get is_enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Page
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Page
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Add children
     *
     * @param Zorbus\PageBundle\Entity\Page $children
     * @return Page
     */
    public function addChildren(\Zorbus\PageBundle\Entity\Page $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param Zorbus\PageBundle\Entity\Page $children
     */
    public function removeChildren(\Zorbus\PageBundle\Entity\Page $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add page_blocks
     *
     * @param Zorbus\PageBundle\Entity\PageBlock $pageBlocks
     * @return Page
     */
    public function addPageBlock(\Zorbus\PageBundle\Entity\PageBlock $pageBlocks)
    {
        $this->page_blocks[] = $pageBlocks;

        return $this;
    }

    /**
     * Remove page_blocks
     *
     * @param Zorbus\PageBundle\Entity\PageBlock $pageBlocks
     */
    public function removePageBlock(\Zorbus\PageBundle\Entity\PageBlock $pageBlocks)
    {
        $this->page_blocks->removeElement($pageBlocks);
    }

    /**
     * Get page_blocks
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getPageBlocks()
    {
        return $this->page_blocks;
    }

    /**
     * Set parent
     *
     * @param Zorbus\PageBundle\Entity\Page $parent
     * @return Page
     */
    public function setParent(\Zorbus\PageBundle\Entity\Page $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return Zorbus\PageBundle\Entity\Page
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set search
     *
     * @param string $search
     * @return Page
     */
    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    /**
     * Get search
     *
     * @return string
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * Set seo_description
     *
     * @param string $seoDescription
     * @return Page
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seo_description = $seoDescription;

        return $this;
    }

    /**
     * Get seo_description
     *
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->seo_description;
    }

    /**
     * Set seo_keywords
     *
     * @param string $seoKeywords
     * @return Page
     */
    public function setSeoKeywords($seoKeywords)
    {
        $this->seo_keywords = $seoKeywords;

        return $this;
    }

    /**
     * Get seo_keywords
     *
     * @return string
     */
    public function getSeoKeywords()
    {
        return $this->seo_keywords;
    }

    /**
     * Set cache_ttl
     *
     * @param integer $cacheTtl
     * @return Page
     */
    public function setCacheTtl($cacheTtl)
    {
        $this->cache_ttl = $cacheTtl;

        return $this;
    }

    /**
     * Get cache_ttl
     *
     * @return integer
     */
    public function getCacheTtl()
    {
        return $this->cache_ttl;
    }
    /**
     * @var string $password
     */
    private $password;


    /**
     * Set password
     *
     * @param string $password
     * @return Page
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @var string $service
     */
    private $service;


    /**
     * Set service
     *
     * @param string $service
     * @return Page
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set redirect
     *
     * @param string $redirect
     * @return Page
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;

        return $this;
    }

    /**
     * Get redirect
     *
     * @return string
     */
    public function getRedirect()
    {
        return $this->redirect;
    }
}
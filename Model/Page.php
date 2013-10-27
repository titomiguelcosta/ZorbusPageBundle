<?php

namespace Zorbus\PageBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Zorbus\PageBundle\Model\PageInterface;
use Zorbus\PageBundle\Model\PageBlockInterface;

/**
 * @Gedmo\Tree(type="nested")
 * @ORM\MappedSuperclass
 */
abstract class Page implements PageInterface {

    public function __toString() {
        return $this->getTitle();
    }

    /**
     * @ORM\OneToMany(targetEntity="Zorbus\PageBundle\Model\PageBlockInterface", mappedBy="page")
     */
    protected $pageBlocks;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $subtitle;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $lang;

    /**
     * @Gedmo\Slug(fields={"title"}, separator="-")
     * @ORM\Column(length=255, unique=true)
     */
    protected $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $theme;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $redirect;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $password;

    /**
     * @ORM\Column(type="text")
     */
    protected $searchTerms;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $seoDescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $seoKeywords;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $cacheTtl;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $enabled;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    private $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Zorbus\PageBundle\Model\PageInterface", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Zorbus\PageBundle\Model\PageInterface", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    protected $updated;

    public function __construct() {
        $this->children = new ArrayCollection();
        $this->pageBlocks = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setSubtitle($subtitle) {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getSubtitle() {
        return $this->subtitle;
    }

    public function setLang($lang) {
        $this->lang = $lang;

        return $this;
    }

    public function getLang() {
        return $this->lang;
    }

    public function setSlug($slug) {
        $this->slug = $slug;

        return $this;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function setUrl($url) {
        $this->url = $url;

        return $this;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setTheme($theme) {
        $this->theme = $theme;

        return $this;
    }

    public function getTheme() {

        return $this->theme;
    }

    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setRedirect($redirect) {
        $this->redirect = $redirect;

        return $this;
    }

    public function getRedirect() {
        return $this->redirect;
    }

    public function setSearchTerms($searchTerms) {
        $this->searchTerms = $searchTerms;

        return $this;
    }

    public function getSearchterms() {
        return $this->searchTerms;
    }

    public function setSeoDescription($seoDescription) {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    public function getSeoDescription() {
        return $this->seoDescription;
    }

    public function setSeoKeywords($seoKeywords) {
        $this->seoKeywords = $seoKeywords;

        return $this;
    }

    public function getSeoKeywords() {
        return $this->seoKeywords;
    }

    public function setCacheTtl($cacheTtl) {
        $this->cacheTtl = $cacheTtl;

        return $this;
    }

    public function getCacheTtl() {
        return $this->cacheTtl;
    }

    public function addPageBlock(PageBlockInterface $pageBlocks) {
        $this->pageBlocks[] = $pageBlocks;

        return $this;
    }

    public function removePageBlock(PageBlockInterface $pageBlocks) {
        $this->pageBlocks->removeElement($pageBlocks);
    }

    public function getPageBlocks() {
        return $this->pageBlocks;
    }

    public function setEnabled($enabled) {
        $this->enabled = (boolean) $enabled;

        return $this;
    }

    public function getEnabled() {
        return $this->enabled;
    }

    public function setLft($lft) {
        $this->lft = $lft;

        return $this;
    }

    public function getLft() {
        return $this->lft;
    }

    public function setRgt($rgt) {
        $this->rgt = $rgt;

        return $this;
    }

    public function getRgt() {
        return $this->rgt;
    }

    public function setRoot($root) {
        $this->root = $root;

        return $this;
    }

    public function getRoot() {
        return $this->root;
    }

    public function setLvl($lvl) {
        $this->lvl = $lvl;

        return $this;
    }

    public function getLvl() {
        return $this->lvl;
    }

    public function addChildren(PageInterface $children) {
        $this->children[] = $children;

        return $this;
    }

    public function removeChildren(PageInterface $children) {
        $this->children->removeElement($children);
    }

    public function getChildren() {
        return $this->children;
    }

    public function setParent(PageInterface $parent = null) {
        $this->parent = $parent;

        return $this;
    }

    public function getParent() {
        return $this->parent;
    }

    public function setCreated(\DateTime $created) {
        $this->created = $created;

        return $this;
    }

    public function getCreated() {
        return $this->created;
    }

    public function setUpdatedAt($updated) {
        $this->updated = $updated;

        return $this;
    }

    public function getUpdated() {
        return $this->updated;
    }

    public function isRedirect() {
        return !empty($this->redirect);
    }

}

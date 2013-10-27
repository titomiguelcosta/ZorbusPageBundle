<?php

namespace Zorbus\PageBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Zorbus\PageBundle\Entity\PageBlock;
use Zorbus\PageBundle\Entity\Page;
use Zorbus\BlockBundle\Entity\Block;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

class AdminController extends CRUDController {

    public function pageBlockManageAction($pageId) {
        $page = $this
                ->getDoctrine()
                ->getRepository('ZorbusPageBundle:Page')
                ->findOneBy(array('id' => $pageId));

        if (!$page instanceof Page) {
            throw $this->createNotFoundException('Page does not exist');
        }

        $areas = $this->get($page->getService())->getBlocks();

        $pageBlocks = $this
                ->getDoctrine()
                ->getRepository('ZorbusPageBundle:PageBlock')
                ->getByPageWithBlocks($pageId);

        $associatedPageBlocks = array();
        $associatedBlocksIds = array(0);
        foreach ($pageBlocks as $pageBlock) {
            $associatedPageBlocks[$pageBlock->getSlot()][] = $pageBlock;
            $associatedBlocksIds[] = $pageBlock->getBlock()->getId();
        }

        $blocks = $this
                ->getDoctrine()
                ->getRepository('ZorbusBlockBundle:Block')
                ->getEnabledUnassociatedBlocks($associatedBlocksIds);

        $unassociatedBlocks = array();
        foreach ($blocks as $block) {
            $unassociatedBlocks[$block->getCategory()][] = $block;
        }

        $blockCategories = $this
                ->getDoctrine()
                ->getRepository('ZorbusBlockBundle:Block')
                ->getEnabledCategories();

        return $this->render('ZorbusPageBundle:Admin:pageBlockManage.html.twig', array('page' => $page, 'unassociatedBlocks' => $unassociatedBlocks, 'areas' => $areas, 'pageBlocks' => $associatedPageBlocks, 'categories' => $blockCategories));
    }

    public function pageBlockAssociateAction() {
        $pageId = $this->getRequest()->query->get('pageId');
        $blockId = $this->getRequest()->query->get('blockId');
        $slot = $this->getRequest()->query->get('slot');

        $page = $this->getDoctrine()->getRepository('ZorbusPageBundle:Page')->find($pageId);
        $block = $this->getDoctrine()->getRepository('ZorbusBlockBundle:Block')->find($blockId);

        if (!$page instanceof Page || !$block instanceof Block) {
            return new JsonResponse(array('code' => 500, 'message' => 'Invalid block or page'), 500);
        }

        try {
            $pageBlock = $this->getDoctrine()->getRepository('ZorbusPageBundle:PageBlock')->findOneBy(array('page' => $page, 'block' => $block));
        } catch (NoResultException $exception) {
            
        } catch (NonUniqueResultException $exception) {
            
        }

        if (!$pageBlock instanceof PageBlock) {
            $pageBlock = new PageBlock();
        }
        $pageBlock->setPage($page);
        $pageBlock->setBlock($block);
        $pageBlock->setSlot($slot);
        $pageBlock->setEnabled(true);

        $this->getDoctrine()->getEntityManager()->persist($pageBlock);
        $this->getDoctrine()->getEntityManager()->flush();

        return new JsonResponse(array('code' => 200, 'message' => 'Block associated to the page.'));
    }

    public function pageBlockUnassociateAction() {
        $pageId = $this->getRequest()->query->get('pageId');
        $blockId = $this->getRequest()->query->get('blockId');

        try {
            $page = $this->getDoctrine()->getRepository('ZorbusPageBundle:Page')->find($pageId);
            $block = $this->getDoctrine()->getRepository('ZorbusBlockBundle:Block')->find($blockId);
            $pageBlock = $this->getDoctrine()->getRepository('ZorbusPageBundle:PageBlock')->findOneBy(array('page' => $page, 'block' => $block));

            $this->getDoctrine()->getEntityManager()->remove($pageBlock);
            $this->getDoctrine()->getEntityManager()->flush();
        } catch (\Exception $e) {
            return new JsonResponse(array('code' => 500, 'message' => $e->getMessage()), 500);
        }

        return new JsonResponse(array('code' => 200, 'message' => 'Block removed from the page.'));
    }

}

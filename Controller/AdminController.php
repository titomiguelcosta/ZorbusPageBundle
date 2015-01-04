<?php

namespace Zorbus\PageBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Zorbus\PageBundle\Model\PageBlock;
use Zorbus\PageBundle\Model\Page;
use Zorbus\BlockBundle\Entity\Block;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

class AdminController extends CRUDController
{
    public function pageBlockManageAction($id)
    {
        $page = $this
                ->getDoctrine()
                ->getRepository($this->container->getParameter('zorbus.page.entities.page'))
                ->findOneBy(array('id' => $id));

        if (!$page instanceof Page) {
            throw $this->createNotFoundException('Page does not exist');
        }

        $slots = $this->get($page->getTheme())->getSlots();

        $pageBlocks = $this
                ->getDoctrine()
                ->getRepository($this->container->getParameter('zorbus.page.entities.page_block'))
                ->getByPageWithBlocks($id);

        $associatedPageBlocks = array();
        $associatedBlocksIds = array();
        foreach ($pageBlocks as $pageBlock) {
            $associatedPageBlocks[$pageBlock->getSlot()][] = $pageBlock;
            $associatedBlocksIds[] = $pageBlock->getBlock()->getId();
        }

        $blocks = $this
                ->getDoctrine()
                ->getRepository('ZorbusBlockBundle:Block')
                ->getEnabledUnassociatedBlocks(0 === count($associatedBlocksIds) ? [0] : $associatedBlocksIds);

        $unassociatedBlocks = array();
        foreach ($blocks as $block) {
            $unassociatedBlocks[$block->getCategory()][] = $block;
        }

        $blockCategories = $this
                ->getDoctrine()
                ->getRepository('ZorbusBlockBundle:Block')
                ->getEnabledCategories();

        return $this->render('ZorbusPageBundle:Admin:pageBlockManage.html.twig', array(
            'page' => $page,
            'unassociatedBlocks' => $unassociatedBlocks,
            'slots' => $slots,
            'pageBlocks' => $associatedPageBlocks,
            'categories' => $blockCategories,
        ));
    }

    public function pageBlockAssociateAction(Request $request)
    {
        $pageId = $request->query->get('pageId');
        $blockId = $request->query->get('blockId');
        $slot = $request->query->get('slot');

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
            $entity = $this->container->getParameter('zorbus.page.entities.page_block');
            $pageBlock = new $entity();
        }

        $pageBlock->setPage($page);
        $pageBlock->setBlock($block);
        $pageBlock->setSlot($slot);
        $pageBlock->setEnabled(true);

        $this->getDoctrine()->getManager()->persist($pageBlock);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(array('code' => 200, 'message' => 'Block associated to the page.'));
    }

    public function pageBlockUnassociateAction(Request $request)
    {
        $pageId = $request->query->get('pageId');
        $blockId = $request->query->get('blockId');

        try {
            $page = $this->getDoctrine()->getRepository('ZorbusPageBundle:Page')->find($pageId);
            $block = $this->getDoctrine()->getRepository('ZorbusBlockBundle:Block')->find($blockId);
            $pageBlock = $this->getDoctrine()->getRepository('ZorbusPageBundle:PageBlock')->findOneBy(array('page' => $page, 'block' => $block));

            $this->getDoctrine()->getManager()->remove($pageBlock);
            $this->getDoctrine()->getManager()->flush();
        } catch (\Exception $e) {
            return new JsonResponse(array('code' => 500, 'message' => $e->getMessage()), 500);
        }

        return new JsonResponse(array('code' => 200, 'message' => 'Block removed from the page.'));
    }
}

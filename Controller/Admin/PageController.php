<?php

namespace Zorbus\PageBundle\Controller\Admin;

use Sonata\AdminBundle\Controller\CRUDController;
use Zorbus\PageBundle\Entity\PageBlock;

class PageController extends CRUDController
{

    public function pageBlockManageAction($id)
    {
        $page = $this->getDoctrine()->getRepository('ZorbusPageBundle:Page')->find($id);

        if (!$page)
        {
            throw $this->createNotFoundException('Page does not exist');
        }

        $areas = $this->get($page->getService())->getBlocks();

        $page_blocks = $this->getDoctrine()->getRepository('ZorbusPageBundle:PageBlock')->findBy(array('page' => $id), array('location' => 'ASC', 'position' => 'ASC'));

        $blocks_associated = array();
        $blocks_associated_ids = array(0);
        foreach ($page_blocks as $page_block)
        {
            $blocks_associated[$page_block->getLocation()][] = $page_block;
            $blocks_associated_ids[] = $page_block->getBlock()->getId();
        }

        $blocks = $this->getDoctrine()
                ->getEntityManager()
                ->createQuery('SELECT b FROM ZorbusBlockBundle:Block b WHERE b.id NOT IN (:block_ids) AND b.enabled = :enabled')
                ->setParameter('block_ids', $blocks_associated_ids)
                ->setParameter('enabled', true)
                ->getResult();

        return $this->render('ZorbusPageBundle:Admin:page_block_manage.html.twig', array('page' => $page, 'blocks' => $blocks, 'areas' => $areas, 'page_blocks' => $blocks_associated));
    }

    public function pageBlockAssociateAction()
    {
        $page_id = $this->getRequest()->get('page_id');
        $block_id = $this->getRequest()->get('block_id');
        $location = $this->getRequest()->get('location');

        try
        {
            $page = $this->getDoctrine()->getRepository('ZorbusPageBundle:Page')->find($page_id);
            $block = $this->getDoctrine()->getRepository('ZorbusBlockBundle:Block')->find($block_id);
            $page_block = $this->getDoctrine()->getRepository('ZorbusPageBundle:PageBlock')->findOneBy(array('page' => $page, 'block' => $block));
        }
        catch (\Exception $e)
        {

        }

        if (!$page_block)
        {
            $page_block = new PageBlock();
        }
        $page_block->setPage($page);
        $page_block->setBlock($block);
        $page_block->setLocation($location);
        $page_block->setEnabled(true);

        $this->getDoctrine()->getEntityManager()->persist($page_block);
        $this->getDoctrine()->getEntityManager()->flush();

        return new \Symfony\Component\HttpFoundation\Response('Done');
    }
    public function pageBlockUnassociateAction()
    {
        $page_id = $this->getRequest()->get('page_id');
        $block_id = $this->getRequest()->get('block_id');

        try
        {
            $page = $this->getDoctrine()->getRepository('ZorbusPageBundle:Page')->find($page_id);
            $block = $this->getDoctrine()->getRepository('ZorbusBlockBundle:Block')->find($block_id);
            $page_block = $this->getDoctrine()->getRepository('ZorbusPageBundle:PageBlock')->findOneBy(array('page' => $page, 'block' => $block));

            $this->getDoctrine()->getEntityManager()->remove($page_block);
            $this->getDoctrine()->getEntityManager()->flush();
        }
        catch (\Exception $e)
        {
            return new \Symfony\Component\HttpFoundation\Response($e->getMessage());
        }

        return new \Symfony\Component\HttpFoundation\Response('Done');
    }

}

<?php

namespace Zorbus\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zorbus\PageBundle\Entity\PageBlock;
use Zorbus\PageBundle\Form\PageType;
use Zorbus\PageBundle\Form\PageBlockType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function addAction(Request $request)
    {
        $form = $this->createForm(new PageType());
        if ($request->isMethod('POST'))
        {
            $form->bind($request);

            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($form->getData());
                $em->flush();
            }
        }
        return $this->render('ZorbusPageBundle:Default:add.html.twig', array('form' => $form->createView()));
    }
    public function associateAction(Request $request)
    {
        $form = $this->createForm(new PageBlockType());
        if ($request->isMethod('POST'))
        {
            $form->bind($request);

            if ($form->isValid())
            {
                $page_block = $form->getData();

                $em = $this->getDoctrine()->getManager();
                $em->persist($page_block);
                $em->flush();

                $this->redirect($this->generateUrl('zorbus_page_show', array('id' => $page_block->getPageId())));
            }
        }
        return $this->render('ZorbusPageBundle:Default:associate.html.twig', array('form' => $form->createView()));
    }
    public function showAction($id, Request $request)
    {
        $page = $this->getDoctrine()->getRepository('ZorbusPageBundle:Page')->findOneBy(array('id' => $id));
        $output = array();

        if ($page)
        {
            $allBlocks = $this->getDoctrine()->getRepository('ZorbusPageBundle:Page')->getBlocks($id);
            foreach ($allBlocks as $location => $blocks)
            {
                foreach ($blocks as $block)
                {
                    $config = $this->get(sprintf('zorbus.block.config.%s', $block->getType()));
                    $service = $this->get(sprintf('sonata.block.service.%s', $block->getType()));
                    $output[$location][] = $service->execute($config->getModel($block))->getContent();
                }
            }
        }
        return $this->render('ZorbusPageBundle:Default:show.html.twig', array('page' => $page, 'blocks' => $output));
    }
}

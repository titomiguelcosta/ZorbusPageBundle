<?php

namespace Zorbus\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Zorbus\PageBundle\Entity\Page;

class DefaultController extends Controller
{

    public function renderAction($id)
    {
        $page = $this->getDoctrine()->getRepository('ZorbusPageBundle:Page')->findOneBy(array('id' => $id));
        $blocks = array();

        if ($page)
        {
            $pageBlocks = $this->getDoctrine()->getRepository('ZorbusPageBundle:PageBlock')->findBy(array('page' => $page));
            foreach ($pageBlocks as $pageBlock)
            {
                $block = $pageBlock->getBlock();
                if ($block && $block->getEnabled()){
                    $blocks[$pageBlock->getLocation()][] = $block;
                }
            }

            $service = $this->get($page->getService());

            $response = $this->render($service->getTemplate(), array('page' => $page, 'blocks' => $blocks, 'request' => $this->getRequest()));
            $response->setTtl($page->getCacheTtl());

            if ($page->isRedirect())
            {
                return $this->redirect($page->getRedirect());
            }

            return $response;
        }

        return new Response('Invalid page.');
    }
    public function executeAction(Page $page = null)
    {
        $blocks = array();

        if ($page)
        {
            $pageBlocks = $this->getDoctrine()->getRepository('ZorbusPageBundle:PageBlock')->findBy(array('page' => $page));
            foreach ($pageBlocks as $pageBlock)
            {
                $block = $pageBlock->getBlock();
                if ($block && $block->getEnabled()){
                    $blocks[$pageBlock->getLocation()][] = $block;
                }
            }

            $service = $this->get($page->getService());

            $response = $this->render($service->getTemplate(), array('page' => $page, 'blocks' => $blocks, 'request' => $this->getRequest(), 'service' => $service));
            $response->setTtl($page->getCacheTtl());

            if ($page->isRedirect())
            {
                return $this->redirect($page->getRedirect());
            }

            return $response;
        }

        return new Response('Invalid page.');
    }

}

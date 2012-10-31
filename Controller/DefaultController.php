<?php

namespace Zorbus\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    public function renderAction($id, Request $request)
    {
        $page = $this->getDoctrine()->getRepository('ZorbusPageBundle:Page')->findOneBy(array('id' => $id));
        $blocks = array();

        if ($page)
        {
            $pageBlocks = $this->getDoctrine()->getRepository('ZorbusPageBundle:PageBlock')->findBy(array('page' => $page));
            foreach ($pageBlocks as $pageBlock)
            {
                $blocks[$pageBlock->getLocation()][] = $pageBlock->getBlock();
            }

            $service = $this->get($page->getService());

            $response = $this->render($service->getTemplate(), array('page' => $page, 'blocks' => $blocks));
            $response->setTtl($page->getCacheTtl());

            return $response;
        }

        return new Response('Invalid page.');
    }

}
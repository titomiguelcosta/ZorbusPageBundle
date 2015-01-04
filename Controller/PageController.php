<?php

namespace Zorbus\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Zorbus\PageBundle\Model\Page;
use Zorbus\PageBundle\Model\PageBlock;
use Zorbus\BlockBundle\Entity\Block;
use Zorbus\PageBundle\Theme\PageThemeInterface;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller {

    /**
     * Renders a page based on the page id
     * 
     * @param string $pageSlug
     * @return Response
     * @throws NotFoundHttpException
     * 
     * @Route("/page/{pageSlug}/render", name="page_render")
     * @Method({"GET"})
     */
    public function renderAction(Request $request, $pageSlug) {
        $pageEntityName = $this->container->getParameter('zorbus.page.entities.page');
        $pageBlockEntityName = $this->container->getParameter('zorbus.page.entities.page_block');
        
        /** @var Page */
        $page = $this
                ->getDoctrine()
                ->getRepository($pageEntityName)
                ->findOneBy(array('slug' => $pageSlug));
        $blocks = array();

        if ($page instanceof Page) {
            if ($page->isRedirect()) {
                return $this->redirect($page->getRedirect());
            }
            
            /** @var array<PageBlock> */
            $pageBlocks = $this
                    ->getDoctrine()
                    ->getRepository($pageBlockEntityName)
                    ->getByPageWithBlocks($page->getId());
            
            foreach ($pageBlocks as $pageBlock) {
                /** @var Block */
                $block = $pageBlock->getBlock();
                if ($block instanceof Block && $block->getEnabled()) {
                    $blocks[$pageBlock->getSlot()][] = $block;
                }
            }

            /** @var PageThemeInterface */
            $theme = $this->get($page->getTheme());

            /** @var Response */
            $response = $this->render($theme->getTemplate(), array(
                'page' => $page,
                'blocks' => $blocks,
                'theme' => $theme,
                'request' => $request
            ));
            $response->setTtl($page->getCacheTtl());

            return $response;
        }

        throw $this->createNotFoundException('Page does not exist');
    }

    /**
     * 
     * @param Page $page
     * @return type
     * @throws type
     */
    public function executeAction(Request $request, Page $page = null) {
        return $this->renderAction($request, $page->getSlug());
    }
}

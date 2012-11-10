<?php

namespace Zorbus\PageBundle\Router;

use Symfony\Cmf\Component\Routing\RouteRepositoryInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Doctrine\ORM\EntityManager;

class PageRouter implements RouteRepositoryInterface, RouterInterface
{

    protected $em;
    protected $context;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function findManyByUrl($url)
    {
        $pages = $this->em->getRepository('ZorbusPageBundle:Page')->findBy(array('url' => $url));

        $routeCollection = new RouteCollection();

        foreach ($pages as $page)
        {
            $route = new Route($page->getUrl(), array('_controller' => 'ZorbusPageBundle:Default:execute', 'page' => $page));
            $routeCollection->add('zorbus_page_' . $page->getId(), $route);
        }

        return $routeCollection;
    }

    public function getRouteByName($name, $parameters = array())
    {
        if (preg_match('/^zorbus_page_/', $name))
        {
            $id = (int) str_replace('zorbus_page_', '', $name);
            $page = $this->em->getRepository('ZorbusPageBundle:Page')->findOneBy(array('id' => $id));

            if ($page)
            {
                $route = new Route($name, array('_controller' => 'ZorbusPageBundle:Default:execute', 'page' => $page));

                return $route;
            }
        }

        throw new RouteNotFoundException();
    }

    public function getRouteCollection()
    {
        $pages = $this->em->getRepository('ZorbusPageBundle:Page')->findBy(array('enabled' => true));

        $routeCollection = new RouteCollection();

        foreach ($pages as $page)
        {
            $route = new Route($page->getUrl(), array(
                        '_controller' => 'ZorbusPageBundle:Default:execute',
                        'page' => $page,
                        '_route' => 'zorbus_page_' . $page->getId()
                    ));

            $routeCollection->add('zorbus_page_' . $page->getId(), $route);
        }

        return $routeCollection;
    }

    public function generate($name, $parameters = array(), $absolute = false)
    {
        return $this->getRouteByName($name, $parameters);
    }

    public function match($pathinfo)
    {
        $page = $this->em->getRepository('ZorbusPageBundle:Page')->findOneBy(array('url' => $pathinfo));

        if ($page)
        {
            return array(
                '_controller' => 'ZorbusPageBundle:Default:execute',
                'page' => $page,
                '_route' => 'zorbus_page_' . $page->getId()
            );
        }

        throw new ResourceNotFoundException('No page found');
    }

    public function setContext(RequestContext $context)
    {
        $this->context = $context;
    }

    public function getContext()
    {
        return $this->context;
    }

}
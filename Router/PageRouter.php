<?php

namespace Zorbus\PageBundle\Router;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Zorbus\PageBundle\Model\Page;

class PageRouter implements RouterInterface
{
    protected $entityManager;
    protected $pageEntity;
    protected $context;

    public function __construct(EntityManager $entityManager, $pageEntity)
    {
        $this->entityManager = $entityManager;
        $this->pageEntity = $pageEntity;
    }

    public function getRouteCollectionForRequest(Request $request)
    {
        return $this->findManyByUrl($request->getPathInfo());
    }

    public function findManyByUrl($url)
    {
        $pages = $this
                ->getEntityManager()
                ->getRepository($this->pageEntity)
                ->findBy(array('url' => $url, 'enabled' => true));

        $routeCollection = new RouteCollection();

        foreach ($pages as $page) {
            $route = new Route($page->getUrl(), array('_controller' => 'ZorbusPageBundle:Page:execute', 'page' => $page));
            $routeCollection->add('zorbus_page_'.$page->getId(), $route);
        }

        return $routeCollection;
    }

    public function getRoutesByNames($names, $parameters = array())
    {
        $routes = array();

        if (!is_array($names)) {
            $names = array($names);
        }

        foreach ($names as $name) {
            $routes[] = $this->getRouteByName($name, $parameters);
        }

        return $routes;
    }

    public function getRouteByName($name, $parameters = array())
    {
        if (preg_match('/^zorbus_page_/', $name)) {
            $id = (int) str_replace('zorbus_page_', '', $name);
            $page = $this
                    ->getEntityManager()
                    ->getRepository($this->pageEntity)
                    ->findOneBy(array('id' => $id));

            if ($page instanceof Page) {
                $route = new Route($name, array('_controller' => 'ZorbusPageBundle:Page:execute', 'page' => $page));

                return $route;
            }
        }

        throw new RouteNotFoundException();
    }

    public function getRouteCollection()
    {
        $pages = $this
                ->getEntityManager()
                ->getRepository($this->pageEntity)
                ->findBy(array('enabled' => true));

        $routeCollection = new RouteCollection();

        foreach ($pages as $page) {
            $route = new Route($page->getUrl(), array(
                '_controller' => 'ZorbusPageBundle:Page:execute',
                'page' => $page,
                '_route' => 'zorbus_page_'.$page->getId(),
            ));

            $routeCollection->add('zorbus_page_'.$page->getId(), $route);
        }

        return $routeCollection;
    }

    public function generate($name, $parameters = array(), $absolute = false)
    {
        if (preg_match('/^zorbus_page_/', $name)) {
            $id = (int) str_replace('zorbus_page_', '', $name);
            $page = $this
                    ->getEntityManager()
                    ->getRepository($this->pageEntity)
                    ->findOneBy(array('id' => $id));

            if ($page instanceof Page) {
                return $page->getUrl();
            }
        }

        throw new RouteNotFoundException();
    }

    public function match($pathinfo)
    {
        $page = $this
                ->getEntityManager()
                ->getRepository($this->pageEntity)
                ->findOneBy(array('url' => $pathinfo, 'enabled' => true));

        if ($page instanceof Page) {
            return array(
                '_controller' => 'ZorbusPageBundle:Page:execute',
                'page' => $page,
                '_route' => 'zorbus_page_'.$page->getId(),
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

    public function getEntityManager()
    {
        return $this->entityManager;
    }
}

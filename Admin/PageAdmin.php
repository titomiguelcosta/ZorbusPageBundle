<?php

namespace Zorbus\PageBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class PageAdmin extends Admin
{
    public function configure()
    {
        $this->setTemplate('edit', 'ZorbusPageBundle:Admin:edit.html.twig');
    }
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->with('Information')
                ->add('title')
                ->add('subtitle', null, array('required' => false))
                ->add('url')
                ->add('service', 'page_themes', array('required' => true, 'label' => 'Theme'))
                ->end()
                ->with('Configuration')
                ->add('parent', null, array(
                    'class' => 'Zorbus\\PageBundle\\Entity\\Page',
                    'multiple' => false,
                    'expanded' => false,
                    'required' => false,
                    'attr' => array('class' => 'select2 span5')
                ))
                ->add('redirect')
                ->add('enabled', null, array('required' => false))
                ->end()
                ->with('SEO', array('collapsed' => true))
                ->add('seo_description', null, array('label' => 'Description'))
                ->add('seo_keywords', null, array('label' => 'Keywords'))
                ->end()
                ->with('Cache', array('collapsed' => true))
                ->add('cache_ttl', null, array('label' => 'Time to live in seconds'))
                ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
                ->add('title')
                ->add('url')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->addIdentifier('title')
                ->add('url')
                ->add('enabled')
        ;
    }

    public function configureShowFields(ShowMapper $filter)
    {
        $filter
                ->add('title')
                ->add('subtitle')
                ->add('url')
                ->add('service')
                ->add('parent')
                ->add('redirect')
                ->add('seo_description')
                ->add('seo_keywords')
                ->add('cache_ttl')
                ->add('enabled')
        ;
    }

    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement
                ->with('title')
                ->assertNotBlank()
                ->assertMaxLength(array('limit' => 255))
                ->end()
                ->with('service')
                ->assertNotBlank()
                ->assertMaxLength(array('limit' => 255))
                ->end()
                ->with('url')
                ->assertNotBlank()
                ->assertRegex(array('pattern' => '/^(\/[a-z0-9_\-]+)+(#[a-z0-9]+)?$/'))
                ->end()
                ->with('redirect')
                ->assertUrl()
                ->end()
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        $collection->add('pageBlockManage', $this->getRouterIdParameter() . '/block/manage');
        $collection->add('pageBlockAssociate', 'block/associate');
        $collection->add('pageBlockUnassociate', 'block/unassociate');
    }

}
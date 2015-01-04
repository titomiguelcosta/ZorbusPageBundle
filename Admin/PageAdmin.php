<?php

namespace Zorbus\PageBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Type;

class PageAdmin extends Admin
{
    protected $baseRouteName = 'page_admin';
    protected $baseRoutePattern = 'page';

    public function configure()
    {
        $this->setTemplate('edit', 'ZorbusPageBundle:Admin:edit.html.twig');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->with('Information')
                ->add('title', null, array(
                    'constraints' => array(
                        new NotBlank(),
                        new Length(array('max' => 255)),
                    ),
                    'attr' => array(
                        'title' => 'title',
                    ),
                ))
                ->add('subtitle', null, array(
                    'required' => false,
                    'constraints' => array(
                        new Length(array('max' => 255)),
                    ),
                ))
                ->add('url', null, array(
                    'constraints' => array(
                        new NotBlank(),
                        new Regex(array('pattern' => '/^\/([a-z0-9_\-]+\/?)*(#[a-z0-9_\-]+)?$/')),
                    ),
                ))
                ->add('theme', 'zorbus_page_themes', array(
                    'required' => true,
                    'label' => 'Theme',
                    'constraints' => array(
                        new NotBlank(),
                    ),
                ))
                ->end()
                ->with('Configuration')
                ->add('parent', 'entity', array(
                    'class' => $this->getClass(),
                    'multiple' => false,
                    'expanded' => false,
                    'required' => false,
                    'attr' => array('class' => 'select2 span5'),
                    'constraints' => array(
                        new Type(array(
                            'type' => $this->getClass(),
                                )),
                    ),
                ))
                ->add('redirect', null, array(
                    'constraints' => array(
                        new Url(),
                    ),
                ))
                ->add('enabled', null, array('required' => false))
                ->end()
                ->with('SEO', array('collapsed' => true))
                ->add('searchTerms', null, array('label' => 'Search'))
                ->add('seoDescription', null, array('label' => 'Description'))
                ->add('seoKeywords', null, array('label' => 'Keywords'))
                ->end()
                ->with('Cache', array('collapsed' => true))
                ->add('cacheTtl', null, array(
                    'label' => 'Cache in seconds',
                    'constraints' => array(
                        new Range(array('min' => 0)),
                    ),
                ))
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
                ->add('theme')
                ->add('parent')
                ->add('redirect')
                ->add('search')
                ->add('seo_description')
                ->add('seo_keywords')
                ->add('cache_ttl')
                ->add('enabled')
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        $collection->add('pageBlockManage', $this->getRouterIdParameter().'/block/manage');
        $collection->add('pageBlockAssociate', 'block/associate');
        $collection->add('pageBlockUnassociate', 'block/unassociate');
    }
}

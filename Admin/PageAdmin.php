<?php

namespace Zorbus\PageBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\MaxLength;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Min;
use Symfony\Component\Validator\Constraints\Type;

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
                    ->add('title', null, array('constraints' => array(
                            new NotBlank(),
                            new MaxLength(array('limit' => 255))
                        )
                    ))
                    ->add('subtitle', null, array(
                        'required' => false,
                        'constraints' => array(
                            new MaxLength(array('limit' => 255))
                        )
                    ))
                    ->add('url', null, array(
                        'constraints' => array(
                            new NotBlank(),
                            new Regex(array('pattern' => '/^\/([a-z0-9_\-]+\/?)+(#[a-z0-9_\-]+)?$/'))
                        )
                    ))
                    ->add('service', 'page_themes', array(
                        'required' => true,
                        'label' => 'Theme',
                        'constraints' => array(
                            new NotBlank(),
                        )
                    ))
                ->end()
                ->with('Configuration')
                    ->add('parent', null, array(
                        'class' => 'Zorbus\PageBundle\Entity\Page',
                        'multiple' => false,
                        'expanded' => false,
                        'required' => false,
                        'attr' => array('class' => 'select2 span5'),
                        'constraints' => array(
                            new Type(array(
                                'type' => 'Zorbus\PageBundle\Entity\Page'
                            ))
                        )
                    ))
                    ->add('redirect', null, array(
                        'constraints' => array(
                            new Url()
                        )
                    ))
                    ->add('enabled', null, array('required' => false))
                ->end()
                ->with('SEO', array('collapsed' => true))
                    ->add('seo_description', null, array('label' => 'Description'))
                    ->add('seo_keywords', null, array('label' => 'Keywords'))
                ->end()
                ->with('Cache', array('collapsed' => true))
                    ->add('cache_ttl', null, array(
                        'label' => 'Cache in seconds',
                        'constraints' => array(
                            new Min(array('limit' => 0))
                        )
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
                ->add('service')
                ->add('parent')
                ->add('redirect')
                ->add('seo_description')
                ->add('seo_keywords')
                ->add('cache_ttl')
                ->add('enabled')
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
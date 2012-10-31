<?php
namespace Zorbus\PageBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PageBlockAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('page', null, array('required' => true))
            ->add('block', null, array('group_by' => 'service', 'required' => true))
            ->add('location')
            ->add('position')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('page')
            ->add('block')
            ->add('location')
            ->add('position')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('page')
            ->add('block')
            ->add('location')
            ->add('position')
        ;
    }

    public function validate(ErrorElement $errorElement, $object)
    {
    }
}
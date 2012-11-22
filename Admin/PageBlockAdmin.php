<?php
namespace Zorbus\PageBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\MaxLength;
use Symfony\Component\Validator\Constraints\Min;

class PageBlockAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('page', null, array(
                    'required' => true,
                    'constraints' => array(
                        new NotBlank(),
                        new MaxLength(array('limit' => 255))
                    )
                ))
            ->add('block', null, array(
                'group_by' => 'service',
                'required' => true,
                'constraints' => array(
                    new NotBlank(),
                    new MaxLength(array('limit' => 255))
                )
            ))
            ->add('location', null, array(
                'required' => true,
                'constraints' => array(
                    new NotBlank(),
                    new MaxLength(array('limit' => 255))
                )
            ))
            ->add('position', null, array(
                'required' => false,
                'constraints' => array(
                    new Min(array('limit' => 0))
                )
            ))
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
}
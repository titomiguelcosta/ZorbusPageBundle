<?php

namespace Zorbus\PageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('subtitle')
            ->add('lang')
            ->add('url')
            ->add('theme')
            ->add('is_enabled')
            ->add('parent', null, array('required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Zorbus\PageBundle\Entity\Page'
        ));
    }

    public function getName()
    {
        return 'zorbus_page_page_type';
    }
}

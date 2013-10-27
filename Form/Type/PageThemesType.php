<?php

namespace Zorbus\PageBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Zorbus\PageBundle\DependencyInjection\Compiler\PageThemeCompilerConfig;

class PageThemesType extends AbstractType {

    protected $pageThemesConfig;

    public function __construct(PageThemeCompilerConfig $pageThemesConfig) {
        $this->pageThemesConfig = $pageThemesConfig;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $themes = array();

        foreach ($this->pageThemesConfig->getThemes() as $theme) {
            $themes[$theme->getService()] = $theme->getName();
        }

        $resolver->setDefaults(array(
            'choices' => $themes
        ));
    }

    public function getParent() {
        return 'choice';
    }

    public function getName() {
        return 'zorbus_page_themes';
    }

}

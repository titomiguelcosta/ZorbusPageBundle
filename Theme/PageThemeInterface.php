<?php

namespace Zorbus\PageBundle\Theme;

interface PageThemeInterface {

    /**
     * @return string Id of the service defined in the container
     * @example zorbus.page.theme.three_column
     */
    public function getService();

    /**
     * @return string Sentence describing the theme
     */
    public function getName();

    /**
     * @return array Array with the slots defined in the templated as keys and description as value
     * @example ["left" => "Left column"]
     */
    public function getSlots();

    /**
     * @return string Logical name of the template following Symfony2 conventions
     * @example ZorbusPageBundle:Theme:threeColumn.html.twig
     */
    public function getTemplate();

    /**
     * @return boolean Returns boolean indicating if the theme is enabled or no
     */
    public function isEnabled();
}

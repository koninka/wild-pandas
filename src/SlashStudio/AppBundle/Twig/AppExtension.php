<?php

namespace SlashStudio\AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('age', array($this, 'ageFilter')),
        );
    }

    public function ageFilter($birthday)
    {
        return (new \DateTime($birthday))->diff(new \DateTime('now'))->y;
    }

    public function getName()
    {
        return 'app_extension';
    }
}

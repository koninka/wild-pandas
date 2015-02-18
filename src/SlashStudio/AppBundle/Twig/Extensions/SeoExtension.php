<?php

namespace SlashStudio\AppBundle\Twig\Extensions;

use Sonata\SeoBundle\Twig\Extension\SeoExtension as BaseExtension;

class SeoExtension extends BaseExtension
{

    /**
     * @param boolean $isNeedTags
     * @return string
     */
    public function getTitle($isNeedTags = true)
    {
        $title = strip_tags($this->page->getTitle());

        return $isNeedTags ? sprintf('title>%s</title>', $title) : $title;
    }
}

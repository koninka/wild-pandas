<?php

namespace SlashStudio\AppBundle\Seo;

use Sonata\SeoBundle\Seo\SeoPage;

class Seo
{
    protected $seoPage;

    public function __construct(SeoPage $seoPage)
    {
        $this->seoPage = $seoPage;
    }

    public function addMeta($object)
    {
        $meta = $object->getMeta();

        if (empty($meta)) return;

        $this->seoPage
            ->setTitle($meta->getTitle())
            ->addMeta('name', 'description', $meta->getDescription())
            ->addMeta('name', 'keywords', $meta->getKeywords())
            ->addMeta('property', 'og:title', $meta->getTitle())
            ->addMeta('property', 'og:description', $meta->getDescription());
    }
}
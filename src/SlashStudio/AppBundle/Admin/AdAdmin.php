<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class AdAdmin extends BaseAdmin
{
    protected $translationDomain = 'admin_ad';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('html', 'textarea', ['label' => 'show.label_html', 'required' => false]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name', 'text', ['route' => ['name' => 'show'], 'label' => 'show.label_html']);
        parent::configureListFields($listMapper);
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->add('name', null, ['label' => 'show.label_html']);
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['show', 'edit', 'list']);
    }

}

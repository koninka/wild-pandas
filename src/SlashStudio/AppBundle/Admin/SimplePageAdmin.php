<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class SimplePageAdmin extends BaseAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', 'text')
                   ->add('text', 'textarea');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
        $listMapper->add('_action', 'actions', [
            'actions' => [
                'show' => [],
                'edit' => []
            ]
        ]);
    }


    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->add('name', 'text')->add('text');
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['show', 'list', 'edit']);
    }
}

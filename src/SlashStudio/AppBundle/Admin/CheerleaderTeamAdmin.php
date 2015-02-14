<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class CheerleaderTeamAdmin extends BaseAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->with('General')
                       ->add('name')
                       ->add('description', 'textarea')
                       ->add('image', 'sonata_type_model_list', ['required' => false,], ['link_parameters' => ['context' => 'team']])
                    ->end();
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name', 'text', ['route' => ['name' => 'show']])
                   ->add('description', 'textarea');
        parent::configureListFields($listMapper);
    }


    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->with('General')
                       ->add('name')
                       ->add('description', 'textarea')
                   ->end();
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['show', 'edit']);
    }

}

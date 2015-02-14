<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class AchievementAdmin extends BaseAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', 'text')
                   ->add('team', null, ['disabled' => true])
                   ->add('image', 'sonata_type_model_list', ['required' => false,], ['link_parameters' => ['context' => 'achievements']]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name', 'text', ['route' => ['name' => 'show']]);
        parent::configureListFields($listMapper);
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->add('name');
    }

}

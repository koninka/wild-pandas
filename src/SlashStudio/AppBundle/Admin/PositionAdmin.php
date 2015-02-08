<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PositionAdmin extends BaseAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', 'text');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
        parent::configureListFields($listMapper);
    }


    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->add('name', 'text');
    }
}

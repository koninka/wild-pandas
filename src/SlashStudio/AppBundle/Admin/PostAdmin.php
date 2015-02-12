<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class PostAdmin extends BaseAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title')
                   ->add('subtitle')
                   ->add('text', 'textarea')
                   ->add('showOnTheMain', null, ['required' => false]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title', 'text')->add('subtitle')->add('showOnTheMain', 'boolean');
        parent::configureListFields($listMapper);
    }


    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->add('title')->add('subtitle')->add('showOnTheMain', 'boolean');
    }

}

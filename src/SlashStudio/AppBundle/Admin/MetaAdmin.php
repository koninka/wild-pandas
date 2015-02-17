<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class MetaAdmin extends BaseAdmin
{
    protected $translationDomain = 'admin_meta';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title', 'text')
                   ->add('description', 'textarea', ['required' => false])
                   ->add('keywords', 'textarea', ['required' => false]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title')->add('description')->add('keywords');
        parent::configureListFields($listMapper);
    }


    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->add('title')->add('description')->add('keywords');
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        if (!$this->hasParentFieldDescription()) {
            $collection->clear();
        }
    }

}

<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class PostAdmin extends BaseAdmin
{
    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'createdAt',
    ];

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title')
                   ->add('subtitle')
                   ->add('text', 'textarea')
                   ->add('showOnTheMain', null, ['required' => false])
                   ->end()
                   ->with('Meta information')
                       ->add('meta', 'sonata_type_admin', ['btn_add' => false, 'btn_delete' => false, 'label' => false, 'required' => true])
                   ->end();
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

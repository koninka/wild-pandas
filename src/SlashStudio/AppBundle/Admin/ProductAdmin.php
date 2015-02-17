<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class ProductAdmin extends BaseAdmin
{

    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'ASC',
        '_sort_by' => 'name',
    ];

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('translations', 'a2lix_translations')
                   ->add('showOnTheMain', null, ['required' => false])
                   ->add('image', 'sonata_type_model_list', ['required' => false,], ['link_parameters' => ['context' => 'product']])
                   ->end()
                   ->with('Meta information')
                       ->add('meta', 'sonata_type_admin', ['btn_add' => false, 'btn_delete' => false, 'label' => false, 'required' => true])
                   ->end();
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name', null, ['route' => ['name' => 'show']])
                   ->add('description')
                   ->add('price')
                   ->add('showOnTheMain', 'boolean', ['editable' => true]);
        parent::configureListFields($listMapper);
    }


    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->add('name')->add('description')->add('price')->add('showOnTheMain', 'boolean');
    }

}

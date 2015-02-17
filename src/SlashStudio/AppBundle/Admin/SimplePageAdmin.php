<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class SimplePageAdmin extends BaseAdmin
{
    protected $translationDomain = 'admin_pages';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('translations', 'a2lix_translations', [
                        'fields' => [
                            'text' => [
                                'label' => 'show.label_text',
                                'translation_domain' => $this->translationDomain,
                            ]
                        ],
                    ])
                   ->end()
                   ->with('meta')
                       ->add('meta', 'sonata_type_admin', ['btn_add' => false, 'btn_delete' => false, 'label' => false, 'required' => true])
                   ->end();
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name', 'text', ['route' => ['name' => 'show']]);
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
        $collection->clearExcept(['show', 'edit']);
    }
}

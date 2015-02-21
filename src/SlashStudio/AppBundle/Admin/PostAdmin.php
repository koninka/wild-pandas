<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class PostAdmin extends BaseAdmin
{
    protected $translationDomain = 'admin_posts';

    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'createdAt',
    ];

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('translations', 'a2lix_translations', [
                        'fields' => [
                            'title' => [
                                'label' => 'show.label_title',
                                'translation_domain' => $this->translationDomain,
                            ],
                            'subtitle' => [
                                'label' => 'show.label_subtitle',
                                'translation_domain' => $this->translationDomain,
                            ],
                            'rawText' => ['display' => false],
                            'textFormatter' => ['display' => false],
                            'text' => [
                                'label' => 'show.label_text',
                                'translation_domain' => $this->translationDomain,
                                'field_type' => 'sonata_formatter_type',
                                'event_dispatcher' => $formMapper->getFormBuilder()->getEventDispatcher(),
                                'format_field'   => 'textFormatter',
                                'source_field'   => 'rawText',
                                'ckeditor_context' => 'default',
                                'target_field'   => 'text',
                            ],
                        ],
                    ])
                   ->add('showOnTheMain', null, ['required' => false])
                   ->add('image', 'sonata_type_model_list', ['required' => false,], ['link_parameters' => ['context' => 'post']])
                   ->end()
                   ->with('meta')
                       ->add('meta', 'sonata_type_admin', ['btn_add' => false, 'btn_delete' => false, 'label' => false, 'required' => true])
                   ->end();
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title', null, ['route' => ['name' => 'show']])
                   ->add('subtitle')
                   ->add('showOnTheMain', 'boolean', ['editable' => true]);
        parent::configureListFields($listMapper);
    }


    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->add('title')
                   ->add('subtitle')
                   ->add('showOnTheMain', 'boolean');
    }

}

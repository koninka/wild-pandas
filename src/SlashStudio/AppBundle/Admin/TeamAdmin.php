<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class TeamAdmin extends BaseAdmin
{
    protected $translationDomain = 'admin_team';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->with('general')
                       ->add('translations', 'a2lix_translations', [
                           'fields' => [
                               'name' => [
                                   'label' => 'show.label_name',
                                   'translation_domain' => $this->translationDomain,

                               ],
                               'rawDescription' => ['display' => false],
                               'descriptionFormatter' => ['display' => false],
                               'description' => [
                                  'label' => 'show.label_description',
                                  'translation_domain' => $this->translationDomain,
                                  'field_type' => 'sonata_formatter_type',
                                  'event_dispatcher' => $formMapper->getFormBuilder()->getEventDispatcher(),
                                  'format_field'   => 'descriptionFormatter',
                                  'source_field'   => 'rawDescription',
                                  'ckeditor_context' => 'default',
                                  'target_field'   => 'description',
                               ],
                               'managerName' => [
                                   'required' => false,
                                   'label' => 'show.label_manager_name',
                                   'translation_domain' => $this->translationDomain,
                               ],
                           ],
                       ])
                       ->add('image', 'sonata_type_model_list', ['required' => false,], ['link_parameters' => ['context' => 'team']])
                       ->add('gallery', 'sonata_type_model_list', ['required' => false], [
                            'link_parameters' => [
                                'context'  => 'team_video',
                                'filter'   => ['context' => ['value' => 'team_video']]
                            ]
                       ])
                       ->add('photoGallery', 'sonata_type_model_list', ['required' => false], [
                            'link_parameters' => [
                                'context'  => 'team_photo',
                                'filter'   => ['context' => ['value' => 'team_photo']]
                            ]
                       ])
                       ->end()
                    ->with('show.label_achievements')
                       ->add(
                            'achievements',
                            'sonata_type_collection',
                            ['by_reference' => false, 'label' => false],
                            [ 'edit' => 'inline', 'inline' => 'table']
                        )
                   ->end()
                   ->with('contacts', array('collapsed' => true))
                       ->add('captain', 'sonata_type_model_list', ['btn_add' => false, 'required' => false])
                       ->add('managerPhone', 'text', ['required' => false])
                       ->add('managerEmail', 'text', ['required' => false])
                    ->end();
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->with('general')
                       ->add('name')
                       ->add('description', 'textarea')
                       ->add('achievements', 'sonata_type_model_list')
                   ->end()
                   ->with('contacts')
                       ->add('captain', null, ['route' => ['name' => 'show']])
                       ->add('managerName', 'text', ['required' => false])
                       ->add('managerPhone', 'text', ['required' => false])
                       ->add('managerEmail', 'text', ['required' => false])
                    ->end();
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['show', 'edit']);
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $a = $query->getRootAlias();
        $query->addSelect('p')->leftJoin("$a.captain", 'p');

        return $query;
    }

}

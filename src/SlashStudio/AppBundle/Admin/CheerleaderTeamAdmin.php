<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class CheerleaderTeamAdmin extends BaseAdmin
{
    protected $translationDomain = 'admin_cheerleader_team';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->with('general')
                       ->add('translations', 'a2lix_translations', [
                            'fields' => [
                                'name' => [
                                    'label' => 'show.label_team_name',
                                    'translation_domain' => $this->translationDomain,
                                ],
                                'description' => [
                                    'label' => 'show.label_description',
                                    'translation_domain' => $this->translationDomain,
                                ],
                            ],
                        ])
                       ->add('image', 'sonata_type_model_list', ['required' => false,], ['link_parameters' => ['context' => 'team']])
                       ->add('gallery', 'sonata_type_model_list', ['required' => false], [
                            'link_parameters' => [
                                'context'  => 'cheerleader_team_video',
                                'filter'   => ['context' => ['value' => 'cheerleader_team_video']]
                            ]
                       ])
                    ->end();
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->with('general')
                       ->add('name', null, ['label' => 'show.label_team_name'])
                       ->add('description')
                   ->end();
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['show', 'edit']);
    }

}

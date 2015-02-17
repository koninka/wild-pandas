<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class AchievementAdmin extends BaseAdmin
{
    protected $translationDomain = 'admin_team';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('translations', 'a2lix_translations', [
                        'fields' => [
                            'name' => [
                                'label' => 'show.label_name',
                                'translation_domain' => $this->translationDomain,
                            ],
                        ],
                    ])
                   ->add('team', 'a2lix_translatedEntity', [
                        'class' => 'SlashStudio\AppBundle\Entity\Team',
                        'translation_property' => 'name',
                        'disabled' => true,
                    ])
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

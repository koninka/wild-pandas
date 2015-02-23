<?php

namespace SlashStudio\AppBundle\Admin;

use libphonenumber\PhoneNumberFormat;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CheerleaderTeamProposalMembershipAdmin extends BaseAdmin
{
    protected $translationDomain = 'admin_proposals';

    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'createdAt',
    ];

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->with('about')
                       ->add('name')
                       ->add('surname')
                       ->add('patronymic', null, ['required' => false])
                       ->add('age', 'integer', ['attr' => ['min' => 1]])
                       ->add('education', null, ['required' => false])
                       ->add('phone', 'tel', ['default_region' => 'RU', 'format' => PhoneNumberFormat::NATIONAL])
                       ->add('email', 'email')
                   ->end()
                   ->with('choreographic')
                       ->add('choreographicEducation')
                       ->add('choreographicStyle')
                       ->add('choreographicExperience', 'integer', ['attr' => ['min' => 0]])
                       ->add('choreographicExperiencePlaying', 'textarea')
                   ->end()
                   ->with('acrobatic')
                       ->add('acrobaticEducation')
                       ->add('acrobaticExperience', 'integer', ['attr' => ['min' => 0]])
                       ->add('acrobaticElements', 'textarea')
                   ->end()
                   ->with('additionally')
                       ->add('hobby', 'textarea', ['required' => false])
                       ->add('about', 'textarea', ['required' => false])
                   ->end();
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->add('fullname', null, ['route' => ['name' => 'show']])
                   ->add('age')
                   ->add('phone', 'string', [
                        'default_region' => 'RU',
                        'format' => PhoneNumberFormat::NATIONAL,
                        'template' => 'ApplicationSonataAdminBundle:CRUD:list_phone_field.html.twig',
                   ])
                   ->add('email')
                   ->add('education')
                   ->add('choreographicEducation')
                   ->add('acrobaticEducation');
        parent::configureListFields($listMapper);
    }


    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->with('about')
                       ->add('name')
                       ->add('surname')
                       ->add('patronymic')
                       ->add('age')
                       ->add('education')
                       ->add('phone', 'string', [
                            'default_region' => 'RU',
                            'format' => PhoneNumberFormat::NATIONAL,
                            'template' => 'ApplicationSonataAdminBundle:CRUD:show_phone_field.html.twig',
                       ])
                       ->add('email')
                   ->end()
                   ->with('choreographic')
                       ->add('choreographicEducation')
                       ->add('choreographicStyle')
                       ->add('choreographicExperience')
                       ->add('choreographicExperiencePlaying')
                   ->end()
                   ->with('acrobatic')
                       ->add('acrobaticEducation')
                       ->add('acrobaticExperience')
                       ->add('acrobaticElements')
                   ->end()
                   ->with('additionally')
                       ->add('hobby')
                       ->add('about')
                   ->end();
    }
}

<?php

namespace SlashStudio\AppBundle\Admin;

use libphonenumber\PhoneNumberFormat;

use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class TeamProposalMembershipAdmin extends BaseAdmin
{
    protected $translationDomain = 'admin_proposals';

    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'createdAt',
    ];

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->add('name')
                   ->add('surname')
                   ->add('age')
                   ->add('phone', 'string', [
                        'default_region' => 'RU',
                        'format' => PhoneNumberFormat::NATIONAL,
                        'template' => 'ApplicationSonataAdminBundle:CRUD:show_phone_field.html.twig',
                    ])
                   ->add('email')
                   ->add('about')
                   ->add('sportsExperience');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name')
                   ->add('surname')
                   ->add('age', 'integer', ['required' => false, 'attr' => ['min' => 1]])
                   ->add('phone', 'tel', ['default_region' => 'RU', 'format' => PhoneNumberFormat::NATIONAL])
                   ->add('email', 'email')
                   ->add('about', 'textarea', ['required' => false])
                   ->add('sportsExperience', 'textarea', ['required' => false]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('fullname', 'text', ['route' => ['name' => 'show']])
                   ->add('age')
                   ->add('phone', 'string', [
                        'default_region' => 'RU',
                        'format' => PhoneNumberFormat::NATIONAL,
                        'template' => 'ApplicationSonataAdminBundle:CRUD:list_phone_field.html.twig',
                    ])
                   ->add('email');
        parent::configureListFields($listMapper);
    }
}

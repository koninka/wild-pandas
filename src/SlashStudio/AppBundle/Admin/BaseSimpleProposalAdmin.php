<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use libphonenumber\PhoneNumberFormat;

class BaseSimpleProposalAdmin extends BaseAdmin
{
    protected $translationDomain = 'admin_proposals';

    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'createdAt',
    ];

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name')
                   ->add('surname')
                   ->add('phone', 'tel', ['default_region' => 'RU', 'format' => PhoneNumberFormat::NATIONAL])
                   ->add('email', 'email');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('fullname', 'text', ['route' => ['name' => 'show']])
                   ->add('phone', 'string', [
                        'default_region' => 'RU',
                        'format' => PhoneNumberFormat::NATIONAL,
                        'template' => 'ApplicationSonataAdminBundle:CRUD:list_phone_field.html.twig',
                    ])
                   ->add('email');
        parent::configureListFields($listMapper);
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->add('name')
                   ->add('surname')
                   ->add('phone', 'string', [
                        'default_region' => 'RU',
                        'format' => PhoneNumberFormat::NATIONAL,
                        'template' => 'ApplicationSonataAdminBundle:CRUD:show_phone_field.html.twig',
                    ])
                   ->add('email');
    }
}

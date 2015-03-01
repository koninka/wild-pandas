<?php

namespace SlashStudio\AppBundle\Admin;

use libphonenumber\PhoneNumberFormat;

use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class ProposalPurchaseProductAdmin extends BaseAdmin
{
    protected $translationDomain = 'admin_proposals';

    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'createdAt',
    ];

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('fullname', 'text', ['route' => ['name' => 'show']])
                   ->add('phone', 'string', [
                        'default_region' => 'RU',
                        'format' => PhoneNumberFormat::NATIONAL,
                        'template' => 'ApplicationSonataAdminBundle:CRUD:list_phone_field.html.twig',
                    ])
                   ->add('email')
                   ->add('product', null, ['route' => ['name' => 'show']]);
        $this->addListActions($listMapper);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name')
                   ->add('surname')
                   ->add('phone', 'tel', ['default_region' => 'RU', 'format' => PhoneNumberFormat::NATIONAL])
                   ->add('email', 'email')
                   ->add('product');
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
                   ->add('email')
                   ->add('product', null, ['route' => ['name' => 'show']]);
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $a = $query->getRootAlias();
        $query->addSelect(['pr', 'tr'])->leftJoin("$a.product", 'pr')->leftJoin('pr.translations', 'tr');

        return $query;
    }
}

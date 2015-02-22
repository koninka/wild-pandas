<?php

namespace SlashStudio\AppBundle\Admin;

use libphonenumber\PhoneNumberFormat;

use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class ProposalPurchaseProductAdmin extends BaseSimpleProposalAdmin
{

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
        parent::configureFormFields($formMapper);
        $formMapper->add('product');
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        parent::configureShowFields($showMapper);
        $showMapper->add('product', null, ['route' => ['name' => 'show']]);
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $a = $query->getRootAlias();
        $query->addSelect(['pr', 'tr'])->leftJoin("$a.product", 'pr')->leftJoin('pr.translations', 'tr');

        return $query;
    }
}

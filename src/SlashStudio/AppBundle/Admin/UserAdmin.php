<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\UserBundle\Admin\Model\UserAdmin as BaseUserAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class UserAdmin extends BaseUserAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('username')
                ->add('email')
                ->add('plainPassword', 'text', array(
                    'required' => (!$this->getSubject() || is_null($this->getSubject()->getId()))
                ))
            ->end()
            ->with('Groups')
            ->add('groups', 'sonata_type_model', array(
                'required' => false,
                'expanded' => true,
                'multiple' => true,
                'btn_add'  => false,
            ))
            ->end()
            ->with('Profile')
                ->add('firstname', null, array('required' => false))
                ->add('lastname', null, array('required' => false))
                ->add('phone', null, array('required' => false))
            ->end()
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        parent::configureListFields($listMapper);
        $listMapper
            ->remove('groups')
            ->remove('locked')
            ->remove('impersonating')
        ;
    }


    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('General')
                ->add('username')
                ->add('email')
            ->end()
            ->with('Profile')
                ->add('firstname')
                ->add('lastname')
                ->add('phone')
            ->end()
        ;
    }

}

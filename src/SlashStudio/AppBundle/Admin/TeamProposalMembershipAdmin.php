<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TeamProposalMembershipAdmin extends BaseSimpleProposalAdmin
{
    protected function configureShowFields(ShowMapper $showMapper)
    {
        parent::configureShowFields($showMapper);
        $showMapper->add('about')->add('sportsExperience');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);
        $formMapper->add('about', 'textarea', ['required' => false])
                   ->add('sportsExperience', 'textarea', ['required' => false]);
    }
}

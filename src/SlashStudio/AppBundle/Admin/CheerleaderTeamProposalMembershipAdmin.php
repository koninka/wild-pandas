<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CheerleaderTeamProposalMembershipAdmin extends BaseAdmin
{
    protected $translationDomain = 'admin_player_group';

    protected function configureFormFields(FormMapper $formMapper)
    {
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        parent::configureListFields($listMapper);
    }


    protected function configureShowFields(ShowMapper $showMapper)
    {
    }
}

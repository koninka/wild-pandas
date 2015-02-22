<?php

namespace SlashStudio\AppBundle\Form\Type;

class TeamProposalMembershipType extends BaseSimpleProposalType
{
    public function __construct()
    {
        $this->class = 'TeamProposalMembership';
    }

    public function getName()
    {
        return 'team_proposal_membership';
    }
}
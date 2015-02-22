<?php

namespace SlashStudio\AppBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class ProposalPurchaseProductType extends BaseSimpleProposalType
{
    public function __construct()
    {
        $this->class = 'ProposalPurchaseProduct';
    }

    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {
        parent::buildForm($builder);
    }

    public function getName()
    {
        return 'proposal_purchase_product';
    }
}

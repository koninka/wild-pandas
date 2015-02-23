<?php

namespace SlashStudio\AppBundle\Form\Type;

use libphonenumber\PhoneNumberFormat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TeamProposalMembershipType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {
        $builder
            ->add('name', null, ['label' => 'form.name'])
            ->add('surname', null, ['label' => 'form.surname'])
            ->add('phone', 'tel', [
                'label' => 'form.phone',
                'default_region' => 'RU',
                'format' => PhoneNumberFormat::NATIONAL,
            ])
            ->add('email', 'email', ['label' => 'form.email',])
        ;
        if (!$options['main_page']) {
            $builder->add('age', 'integer', ['label' => 'form.age', 'attr' => ['min' => 1]])
                    ->add('about', 'textarea', ['required' => false, 'label' => 'form.about'])
                    ->add('sportsExperience', 'textarea', ['required' => false, 'label' => 'form.sports_experience']);
        }
        $builder->add('send', 'submit', ['label' => 'form.send']);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'main_page' => false,
            'translation_domain' => 'form_proposals',
            'data_class' => 'SlashStudio\AppBundle\Entity\TeamProposalMembership',
        ));
    }

    public function getName()
    {
        return 'team_proposal_membership';
    }
}
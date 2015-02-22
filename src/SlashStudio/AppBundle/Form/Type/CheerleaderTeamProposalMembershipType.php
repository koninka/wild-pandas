<?php

namespace SlashStudio\AppBundle\Form\Type;

use libphonenumber\PhoneNumberFormat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CheerleaderTeamProposalMembershipType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {
        $builder
            ->add('name', null, ['label' => 'form.name'])
            ->add('surname', null, ['label' => 'form.surname'])
            ->add('patronymic', null, ['required' => false, 'label' => 'form.patronymic'])
            ->add('age', 'integer', ['label' => 'form.age', 'attr' => ['min' => 1]])
            ->add('education', null, ['label' => 'form.education', 'required' => false])
            ->add('phone', 'tel', ['label' => 'form.phone', 'default_region' => 'RU', 'format' => PhoneNumberFormat::NATIONAL])
            ->add('email', 'email', ['label' => 'form.email'])
            ->add('choreographicEducation', null, ['label' => 'form.choreographic_education'])
            ->add('choreographicStyle', null, ['label' => 'form.choreographic_style'])
            ->add('choreographicExperience', 'integer', ['label' => 'form.choreographic_experience', 'attr' => ['min' => 0]])
            ->add('choreographicExperiencePlaying', 'textarea', ['label' => 'form.choreographic_experience_playing'])
            ->add('acrobaticEducation', null, ['label' => 'form.acrobatic_education'])
            ->add('acrobaticExperience', 'integer', ['label' => 'form.acrobatic_experience', 'attr' => ['min' => 0]])
            ->add('acrobaticElements', 'textarea', ['label' => 'form.acrobatic_elements'])
            ->add('hobby', 'textarea', ['required' => false, 'label' => 'form.hobby'])
            ->add('about', 'textarea', ['required' => false, 'label' => 'form.about'])
            ->add('send', 'submit', ['label' => 'form.send']);
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SlashStudio\AppBundle\Entity\CheerleaderTeamProposalMembership',
            'translation_domain' => 'form_proposals',
        ));
    }

    public function getName()
    {
        return 'cheerleader_team_proposal_membership';
    }
}
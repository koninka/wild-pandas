<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Doctrine\DBAL\Types\Type;

class PlayerAdmin extends BaseAdmin
{
    const BIRTHDAY_FORMAT = 'd.m.Y';

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('fullname', 'text', ['route' => ['name' => 'show']])
            ->add('birthday', 'datetime', ['format' => static::BIRTHDAY_FORMAT])
            ->add('nationality.name')
            ->add('email', 'text')
            ->add('phone', 'text')
            ->add('weight', 'decimal')
            ->add('height', 'decimal')
            ->add('number', 'number')
            ->add('structure', 'choice', ['choices' => Type::getType('structureEnumType')->getChoices()])
            ->add('position.name');
            // ->add('position.name');
        parent::configureListFields($listMapper);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        // $mediaAdmin = $this->configurationPool->getAdminByClass("SlashStudio\\AppBundle\\Entity\\Nationality");
        
        $formMapper
            ->with('General')
                ->add('translations', 'a2lix_translations')
                ->add('birthday', 'sonata_type_date_picker', ['format' => 'dd/MM/yyyy'])
                ->add('nationality', 'sonata_type_model_list', ['required' => false])
                ->add('photo', 'sonata_type_model_list', [
                    'required' => false,
                ], ['link_parameters' => ['context' => 'players']])
            ->end()
            ->with('Contacts')
                ->add('email', 'text', ['required' => false])
                ->add('phone', 'text', ['required' => false])
                ->end()
            ->with('Characteristics')
                ->add('weight', 'number')
                ->add('height', 'number')
                ->add('number', 'number')
                ->add('position', 'sonata_type_model_list')
//                ->add('position', 'sonata_type_model_list')
                ->add('structure', 'choice', ['choices' => Type::getType('structureEnumType')->getChoices()])
            ->end();
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('General')
                ->add('surname')
                ->add('birthday', 'datetime', ['format' => static::BIRTHDAY_FORMAT])
                ->add('nationality')
            ->end()
            ->with('Contacts')
                ->add('email', 'text')
                ->add('phone', 'text')
            ->end()
            ->with('Characteristics')
                ->add('weight', 'number')
                ->add('height', 'number')
                ->add('number', 'number')
                ->add('position', null, ['route' => ['name' => 'show']])
                ->add('structure', 'choice', ['choices' => Type::getType('structureEnumType')->getChoices()])
            ->end();
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $a = $query->getRootAlias();
        $query->addSelect(['p', 'n', 't'])->join("$a.position", 'p')->leftJoin("$a.nationality", 'n')->leftJoin("$a.translations", 't');

        return $query;
    }
}

<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Doctrine\DBAL\Types\Type;

class PlayerAdmin extends BaseAdmin
{
    protected $translationDomain = 'admin_player';

    const BIRTHDAY_FORMAT = 'd.m.Y';

    private function getChoices()
    {
        $result = [];
        foreach (Type::getType('structureEnumType')->getChoices() as $k => $choice) {
            $result[$k] = $this->trans($choice);
        }

        return $result;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('fullname', 'text', ['route' => ['name' => 'show']])
            ->add('birthday', 'datetime', ['format' => static::BIRTHDAY_FORMAT])
            ->add('nationality')
            ->add('email', 'text')
            ->add('phone', 'text')
            ->add('weight', 'decimal')
            ->add('height', 'decimal')
            ->add('number', 'number')
            ->add('structure', 'choice', ['choices' => $this->getChoices()])
            ->add('position');
            // ->add('position.name');
        parent::configureListFields($listMapper);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        // $mediaAdmin = $this->configurationPool->getAdminByClass("SlashStudio\\AppBundle\\Entity\\Nationality");

        $formMapper
            ->with('general')
                ->add('translations', 'a2lix_translations', [
                    'fields' => [
                        'name' => [
                            'label' => 'show.label_name',
                            'translation_domain' => $this->translationDomain,
                        ],
                        'surname' => [
                            'label' => 'show.label_surname',
                            'translation_domain' => $this->translationDomain,
                        ],
                    ],
                ])
                ->add('birthday', 'sonata_type_date_picker', ['format' => 'dd/MM/yyyy'])
                ->add('nationality', 'sonata_type_model_list', ['required' => false])
                ->add('photo', 'sonata_type_model_list', [
                    'required' => false,
                ], ['link_parameters' => ['context' => 'players']])
            ->end()
            ->with('contacts')
                ->add('email', 'text', ['required' => false])
                ->add('phone', 'text', ['required' => false])
                ->end()
            ->with('characteristics')
                ->add('weight', 'number')
                ->add('height', 'number')
                ->add('number', 'number')
                ->add('position', 'sonata_type_model_list')
//                ->add('position', 'sonata_type_model_list')
                ->add('structure', 'choice', ['choices' => $this->getChoices()])
            ->end();
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('general')
                ->add('name')
                ->add('surname')
                ->add('birthday', 'datetime', ['format' => static::BIRTHDAY_FORMAT])
                ->add('nationality')
            ->end()
            ->with('contacts')
                ->add('email', 'text')
                ->add('phone', 'text')
            ->end()
            ->with('characteristics')
                ->add('weight', 'number')
                ->add('height', 'number')
                ->add('number', 'number')
                ->add('position', null, ['route' => ['name' => 'show']])
                ->add('structure', 'choice', ['choices' => $this->getChoices()])
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

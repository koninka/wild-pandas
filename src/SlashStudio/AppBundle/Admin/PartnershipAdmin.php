<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Doctrine\DBAL\Types\Type;

class PartnershipAdmin extends BaseAdmin
{
    protected $translationDomain = 'admin_content';

    private function getChoices()
    {
        $result = [];
        foreach (Type::getType('partnershipEnumType')->getChoices() as $k => $choice) {
            $result[$k] = $this->trans($choice);
        }

        return $result;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('translations', 'a2lix_translations', [
                        'fields' => [
                            'name' => [
                                'label' => 'show.label_name',
                                'translation_domain' => $this->translationDomain,
                            ],
                        ],
                    ])
                   ->add('type', 'choice', ['choices' => $this->getChoices()])
                   ->add('image', 'sonata_type_model_list', ['required' => false,], ['link_parameters' => ['context' => 'partnership']]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name', null, ['route' => ['name' => 'show']])
                   ->add('type', 'choice', ['choices' => $this->getChoices()]);
        parent::configureListFields($listMapper);
    }


    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->add('name', 'text')->add('type', 'choice', ['choices' => $this->getChoices()]);
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $a = $query->getRootAlias();
        $query->addSelect('t')->leftJoin("$a.translations", 't');

        return $query;
    }
}

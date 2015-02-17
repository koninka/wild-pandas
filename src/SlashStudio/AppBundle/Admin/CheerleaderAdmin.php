<?php

namespace SlashStudio\AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Doctrine\DBAL\Types\Type;

class CheerleaderAdmin extends BaseAdmin
{

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('fullname', 'text', ['route' => ['name' => 'show']])
            ->add('about');
        parent::configureListFields($listMapper);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('translations', 'a2lix_translations', [
                    'fields' => [
                        'name' => ['required' => true],
                        'surname' => ['required' => true],
                        'about' => ['required' => false],
                    ]
                ])
                ->add('photo', 'sonata_type_model_list', ['required' => false,], ['link_parameters' => ['context' => 'cheerleaders']])
            ->end();
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->with('General')
                        ->add('name')
                        ->add('surname')
                        ->add('about')
                  ->end();
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $a = $query->getRootAlias();
        $query->addSelect('t')->leftJoin("$a.translations", 't');

        return $query;
    }
}

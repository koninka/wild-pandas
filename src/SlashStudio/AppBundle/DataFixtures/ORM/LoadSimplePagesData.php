<?php
namespace SlashStudio\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SlashStudio\AppBundle\Entity\SimplePage;

class LoadSimplePagesData implements FixtureInterface
{
    private $manager;

    private function loadPage($name, $ruText, $enText)
    {
        $page = new SimplePage;
        $page->setName($name);

        $page->translate('ru')->setText($ruText);
        $page->translate('en')->setText($enText);

        $page->mergeNewTranslations();

        $this->manager->persist($page);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->loadPage('Тренировки', 'Тренировочки такие тренировочки', 'Lorem ipsum dolor sit amet TRAINIGNS, consectetur adipisicing elit.')
             ->loadPage('История команды', 'Летопись ведется аж с 2012 года!', 'Lorem ipsum HISTORY dolor sit amet, consectetur adipisicing elit.')
             ->loadPage('Детские команды', 'Детская команда-моманда', 'Lorem ipsum dolor sit amet, consectetur adipisicing CHILD TEAMM elit.');

        $this->manager->flush();
    }
}

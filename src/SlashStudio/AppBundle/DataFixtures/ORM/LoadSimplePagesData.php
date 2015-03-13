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
        $page->translate('ru')->setRawText($ruText);
        $page->translate('ru')->setTextFormatter('richhtml');

        $page->translate('en')->setText($enText);
        $page->translate('en')->setRawText($enText);
        $page->translate('en')->setTextFormatter('richhtml');

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

        $this->loadPage('Тренировки', 'Тренировочки такие <b>тренировочки</b>', 'Lorem ipsum dolor sit amet <b>TRAINIGNS</b>, consectetur adipisicing elit.')
             ->loadPage('История команды', 'Летопись ведется <b>аж с 2012 года</b>!', 'Lorem ipsum <b>HISTORY</b> dolor sit amet, consectetur adipisicing elit.')
             ->loadPage('Детские команды', 'Детская <b>команда-моманда</b>', 'Lorem ipsum dolor sit amet, consectetur adipisicing CHILD <b>TEAMM</b> elit.');

        $this->manager->flush();
    }
}

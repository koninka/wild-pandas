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

        $this->loadPage('О наших тренировках', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet <b>TRAINIGNS</b>, consectetur adipisicing elit.')
             ->loadPage('История команды', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum <b>HISTORY</b> dolor sit amet, consectetur adipisicing elit.')
             ->loadPage('Детские команды', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing CHILD <b>TEAMM</b> elit.');



        $this->manager->flush();
    }
}

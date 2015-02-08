<?php
namespace SlashStudio\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SlashStudio\AppBundle\Entity\SimplePage;

class LoadSimplePagesData implements FixtureInterface
{
    private $manager;

    private function loadPage($name, $text)
    {
        $page = new SimplePage;
        $page->setName($name)->setText($text);
        $this->manager->persist($page);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->loadPage('Тренировки', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.')
             ->loadPage('История команды', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.')
             ->loadPage('Детские команды', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.');

        $this->manager->flush();
    }
}

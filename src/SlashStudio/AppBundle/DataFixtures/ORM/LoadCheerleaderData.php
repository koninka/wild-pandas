<?php
namespace SlashStudio\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SlashStudio\AppBundle\Entity\Cheerleader;

class LoadCheerleaderData implements FixtureInterface
{
    private $names = [
        ['Катя', 'Katya'],
        ['Яна', 'Yana'],
        ['Даша', 'Darya'],
        ['Алена', 'Alena'],
    ];

    private $surnames = [
        ['Маштакова', 'Mashtakova'],
        ['Иванова', 'Ivanova'],
        ['Белявцева', 'Belyavtseva'],
        ['Шумей', 'Shumey'],
    ];

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->names as $key => $name) {
            foreach ($this->surnames as $surname) {
                $cheerleader = new Cheerleader();

                $cheerleader->translate('ru')->setName($name[0]);
                $cheerleader->translate('ru')->setSurname($surname[0]);
                $cheerleader->translate('ru')->setAbout('Руководитль студии танца, участница проекта "Мисс Владивосток"');

                $cheerleader->translate('en')->setName($name[1]);
                $cheerleader->translate('en')->setSurname($surname[1]);
                $cheerleader->translate('en')->setAbout('Very good girl!');

                $cheerleader->mergeNewTranslations();

                $manager->persist($cheerleader);
            }
        }
        $manager->flush();
    }
}

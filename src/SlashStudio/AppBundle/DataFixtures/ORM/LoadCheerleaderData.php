<?php
namespace SlashStudio\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SlashStudio\AppBundle\Entity\Cheerleader;

class LoadCheerleaderData implements FixtureInterface
{
    private $names = [
        'Катя',
        'Яна',
        'Даша',
        'Алена',
    ];

    private $surnames = [
        'Маштакова',
        'Иванова',
        'Белявцева',
        'Шумей',
    ];

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->names as $key => $name) {
            foreach ($this->surnames as $surname) {
                $cheerleader = new Cheerleader();
                $cheerleader->setName($name)
                       ->setSurname($surname)
                       ->setAbout('Руководитль студии танца, участница проекта "Мисс Владивосток"');
                $manager->persist($cheerleader);
            }
        }
        $manager->flush();
    }
}

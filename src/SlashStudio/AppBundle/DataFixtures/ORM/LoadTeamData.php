<?php
namespace SlashStudio\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SlashStudio\AppBundle\Entity\Team;
use SlashStudio\AppBundle\Entity\Achievement;

class LoadTeamData implements FixtureInterface
{
    private $names = [
        'Самая молодая команда на Дальнем Востоке!',
        'Самая дорогая спортивная команда на Дальнем Востоке!',
    ];

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $team = new Team();
        $team->setDescription('Команда по американскому футболу из Дальнего Востока');
        $manager->persist($team);
        foreach ($this->names as $name) {
            $a = new Achievement();
            $a->setName($name);
            $team->addAchievement($a);
            $manager->persist($a);
        }
        $manager->flush();
    }
}

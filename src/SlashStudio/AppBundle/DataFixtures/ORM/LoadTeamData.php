<?php
namespace SlashStudio\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SlashStudio\AppBundle\Entity\Team;
use SlashStudio\AppBundle\Entity\Player;
use SlashStudio\AppBundle\Entity\Position;
use SlashStudio\AppBundle\Entity\Achievement;
use SlashStudio\AppBundle\DBAL\StructureEnumType;

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
        $position = new Position;
        $position->setName('Kicker');
        $manager->persist($position);
        $captain = new Player;
        $captain->setName('Роман')
               ->setSurname('Фатьянов')
               ->setNumber(50)
               ->setPosition($position)
               ->setStructure(StructureEnumType::ST_BASIC)
               ->setWeight(100)
               ->setBirthday(new \DateTime('09.01.1992'))
               ->setNationality('Русский')
               ->setHeight(195);
        $manager->persist($captain);
         $team = new Team();
         $team->setDescription('Команда по американскому футболу из Дальнего Востока')
              ->setCaptain($captain)
              ->setManagerName('Николай Стецко')
              ->setManagerPhone('2-666-666')
              ->setManagerEmail('some@example.com');
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

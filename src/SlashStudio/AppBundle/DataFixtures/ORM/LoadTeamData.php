<?php
namespace SlashStudio\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SlashStudio\AppBundle\Entity\Team;
use SlashStudio\AppBundle\Entity\Player;
use SlashStudio\AppBundle\Entity\Position;
use SlashStudio\AppBundle\Entity\Nationality;
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
        $nationality = new Nationality;
        $nationality->setName('США');
        $manager->persist($nationality);
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
               ->setNationality($nationality)
               ->setHeight(195);
        $manager->persist($captain);
        $team = new Team();
        $team->setCaptain($captain)
             ->setManagerPhone('2-666-666')
             ->setManagerEmail('some@example.com')
        ;

        $team->translate('ru')->setName('Дикие панды');
        $team->translate('ru')->setManagerName('Николай Стецко');
        $team->translate('ru')->setDescription('Команда по американскому футболу из Дальнего Востока');

        $team->translate('en')->setName('Wild Pandas');
        $team->translate('en')->setManagerName('Nicholas Stetsko');
        $team->translate('en')->setDescription('American football team from the Far East');

        $team->mergeNewTranslations();

        foreach ($this->names as $name) {
            $a = new Achievement();
            $a->setName($name);
            $team->addAchievement($a);
        }

        $manager->persist($team);
        $manager->flush();
    }
}

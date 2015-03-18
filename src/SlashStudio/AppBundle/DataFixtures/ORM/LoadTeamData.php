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
    private $achievements = [
        ['ru' => 'Самая молодая команда на Дальнем Востоке!', 'en' => 'The youngest team in the Far East!'],
        ['ru' => 'Самая дорогая спортивная команда на Дальнем Востоке!', 'en' => 'The most expensive sports team in the Far East!'],
    ];

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $nationality = new Nationality;


        // $nationality->setName('США');

        $nationality->translate('ru')->setName('США');
        $nationality->translate('en')->setName('USA');

        $nationality->mergeNewTranslations();

        $manager->persist($nationality);
        $position = new Position;

        $position->translate('ru')->setName('Кикер');
        $position->translate('en')->setName('Kicker');

        $position->mergeNewTranslations();
        $manager->persist($position);
        $captain = new Player;
        $captain->setNumber(50)
               ->setPosition($position)
               ->setStructure(StructureEnumType::ST_BASIC)
               ->setWeight(100)
               ->setBirthday(new \DateTime('09.01.1992'))
               ->setNationality($nationality)
               ->setHeight(195);

        $captain->translate('ru')->setName('Рома');
        $captain->translate('ru')->setSurname('Фатьянов');

        $captain->translate('en')->setName('Roma');
        $captain->translate('en')->setSurname('Fatyanov');

        $captain->mergeNewTranslations();

        $manager->persist($captain);

        $team = new Team();
        $team->setCaptain($captain)
             ->setManagerPhone('2-666-666')
             ->setManagerEmail('mtertishniy@gmail.com')
        ;

        $team->translate('ru')->setName('Дикие панды');
        $team->translate('ru')->setManagerName('Николай Стецко');
        $team->translate('ru')->setDescription('Команда по <b>американскому футболу</b> из Дальнего Востока');
        $team->translate('ru')->setRawDescription('Команда по <b>американскому футболу</b> из Дальнего Востока');
        $team->translate('ru')->setDescriptionFormatter('richhtml');

        $team->translate('en')->setName('Wild Pandas');
        $team->translate('en')->setManagerName('Nicholas Stetsko');
        $team->translate('en')->setDescription('American football team from the Far East');
        $team->translate('en')->setRawDescription('<b>American football</b> team from the Far East');
        $team->translate('en')->setDescriptionFormatter('richhtml');

        $team->mergeNewTranslations();

        foreach ($this->achievements as $a) {
            $achievement = new Achievement();
            foreach ($a as $locale => $name) {
                $achievement->translate($locale)->setName($name);
            }
            $achievement->mergeNewTranslations();
            $team->addAchievement($achievement);
        }

        $manager->persist($team);
        $manager->flush();
    }
}

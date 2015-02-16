<?php
namespace SlashStudio\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SlashStudio\AppBundle\Entity\Player;
use SlashStudio\AppBundle\Entity\Position;
use SlashStudio\AppBundle\Entity\Nationality;
use SlashStudio\AppBundle\DBAL\StructureEnumType;

class LoadPlayersData implements FixtureInterface
{
    private $names = [
        'Марк',
        'Костя',
        'Миша',
        'Рыжий',
    ];

    private $surnames = [
        'Тертышный',
        'Ландышев',
        'Злотников',
        'Зинов',
    ];

    private $positionNames = [
        ['Квотербек', 'Quarterback'],
        ['Раннинбек', 'Ranninbek'],
        ['Уайд ресивер', 'Wide Receiver'],
        ['Тайт-энд', 'Tight End'],
        ['Оффенсив гард', 'Guard'],
        ['Оффенсив тэкл', 'Offensiv Tekle'],
    ];

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $positions = [];
        foreach ($this->positionNames as $positionName) {
            $position = new Position();

            $position->translate('ru')->setName($positionName[0]);
            $position->translate('en')->setName($positionName[1]);

            $position->mergeNewTranslations();

            $manager->persist($position);
            $positions[] = $position;
        }
        $nationality = new Nationality;

        $nationality->translate('ru')->setName('Россия');
        $nationality->translate('en')->setName('Russia');

        $nationality->mergeNewTranslations();

        $manager->persist($nationality);
        $number = 0;
        foreach ($this->names as $key => $name) {
            foreach ($this->surnames as $surname) {
                $player = new Player();
                $player->setName($name)
                       ->setSurname($surname)
                       ->setNumber(++$number)
                       ->setPosition($positions[rand(0, count($positions) - 1)])
                       ->setStructure($key < 2 ? StructureEnumType::ST_BASIC : StructureEnumType::ST_ADDITIONAL)
                       ->setWeight(150)
                       ->setBirthday(new \DateTime('09.01.1993'))
                       ->setNationality($nationality)
                       ->setHeight(180);
                $manager->persist($player);
            }
        }
        $manager->flush();
    }
}

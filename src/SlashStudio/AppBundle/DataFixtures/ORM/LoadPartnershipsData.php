<?php
namespace SlashStudio\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SlashStudio\AppBundle\Entity\Partnership;
use SlashStudio\AppBundle\DBAL\PartnershipEnumType;

class LoadPartnershipsData implements FixtureInterface
{
    private $sponsorsName = [
        ['Славда', 'Slavda'],
        ['Владхлеб', 'Vlad-bread'],
        ['Алкомаркет Солнышко', 'Alco sun'],
        ['Примамедиа', 'Primamedia'],
        ['Чайхона', 'Chaihona'],
        ['Шум - супер клаб', 'Shoom - super club'],
        ['Муммий Троль', 'Mummiy Troll'],
    ];

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->sponsorsName as $name) {
            $s = new Partnership();
            $s->setType(rand(1, 40) % 2 ? PartnershipEnumType::ST_SPONSOR : PartnershipEnumType::ST_PARTNER);

            $s->translate('ru')->setName($name[0]);
            $s->translate('en')->setName($name[1]);

            $s->mergeNewTranslations();

            $manager->persist($s);
        }
        $manager->flush();
    }
}

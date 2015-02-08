<?php
namespace SlashStudio\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SlashStudio\AppBundle\Entity\Partnership;
use SlashStudio\AppBundle\DBAL\PartnershipEnumType;

class LoadPartnershipsData implements FixtureInterface
{
    private $sponsorsName = [
        'Славда',
        'Владхлеб',
        'Алкомаркет Солнышко',
        'Primamedia',
        'Чайхона',
        'Shoom - super club',
        'Муммий Троль',
    ];

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->sponsorsName as $name) {
            $s = new Partnership();
            $s->setName($name)->setType(rand(1, 40) % 2 ? PartnershipEnumType::ST_SPONSOR : PartnershipEnumType::ST_PARTNER);
            $manager->persist($s);
        }
        $manager->flush();
    }
}

<?php
namespace SlashStudio\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SlashStudio\AppBundle\Entity\CheerleaderTeam;

class LoadCheerleaderTeamData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $team = new CheerleaderTeam();
        $team->setName('WakeUp')->setDescription('Славные девчонки, которые вдохновляют команду на победы!');
        $manager->persist($team);
        $manager->flush();
    }
}

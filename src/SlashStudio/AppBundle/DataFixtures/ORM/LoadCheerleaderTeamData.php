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
        $team->translate('ru')->setName('WakeUp');
        $team->translate('ru')->setDescription('Славные девчонки, которые вдохновляют команду на победы!');

        $team->translate('en')->setName('WakeUp');
        $team->translate('en')->setDescription('Nice girls who inspire the team to victory!');

        $team->mergeNewTranslations();

        $manager->persist($team);
        $manager->flush();
    }
}

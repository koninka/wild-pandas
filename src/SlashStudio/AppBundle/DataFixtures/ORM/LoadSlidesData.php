<?php
namespace SlashStudio\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SlashStudio\AppBundle\Entity\Slide;

class LoadSlidesData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $slide = new Slide();
            $slide->setPosition(rand(0, 100));

            $slide->translate('ru')->setTitle('Заголовок' . ($i + 1));
            $slide->translate('ru')->setSubtitle('Подзаголовок' . ($i + 1));

            $slide->translate('en')->setTitle('Title' . ($i + 1));
            $slide->translate('en')->setSubtitle('Subtitle' . ($i + 1));

            $slide->mergeNewTranslations();

            $manager->persist($slide);
        }
        $manager->flush();
    }
}

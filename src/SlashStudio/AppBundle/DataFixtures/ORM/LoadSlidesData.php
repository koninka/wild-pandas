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
            $slide = (new Slide)->setTitle('Заголовок' . ($i + 1))
                ->setSubtitle('Подзаголовок' . ($i + 1))
                ->setPosition(rand(0, 100));
            $manager->persist($slide);
        }
        $manager->flush();
    }
}

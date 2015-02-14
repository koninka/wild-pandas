<?php
namespace SlashStudio\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SlashStudio\AppBundle\Entity\Post;
use SlashStudio\AppBundle\Entity\MediaPost;

class LoadPostsData implements FixtureInterface
{
    private $loremIpsum = <<<'EOT'
    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
EOT;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 12; $i++) {
            $post = new Post;
            $post->setTitle("Заголовок$i")
                ->setSubtitle("Lorem ipsum dolor sit amet, consectetur adipisicing elit")
                ->setShowOnTheMain(rand() % 2 == 0)
                ->setText($this->loremIpsum)
                ->setCreatedAt(new \DateTime());
            $mediaPost = new MediaPost;
            $mediaPost->setTitle("ЗаголокМедиа$i")
                      ->setSubtitle('Lorem ipsum dolor sit amet, consectetur adipisicing elit');
            $manager->persist($post);
            $manager->persist($mediaPost);
        }
        $manager->flush();
    }
}

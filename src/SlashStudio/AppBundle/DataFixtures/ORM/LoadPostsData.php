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
            $post->setShowOnTheMain(rand() % 2 == 0)->setCreatedAt(new \DateTime());

            $post->translate('ru')->setTitle("Заголовок$i");
            $post->translate('ru')->setSubtitle('Это подзаголовок самой крутой новости.');
            $post->translate('ru')->setText('Это новость заслуживает того, чтобы находиться здесь. Все дело в том, что без нее здесь было бы пусто...');

            $post->translate('en')->setTitle("Head$i");
            $post->translate('en')->setSubtitle('Lorem ipsum dolor sit amet, consectetur adipisicing elit');
            $post->translate('en')->setText($this->loremIpsum);

            $post->mergeNewTranslations();
            $mediaPost = new MediaPost;

            $mediaPost->translate('ru')->setTitle("ЗаголокМедиа$i");
            $mediaPost->translate('ru')->setSubtitle("Это подзаголовок самой крутой новости$i.");
            $mediaPost->translate('ru')->setText("Это медиа-новость$i заслуживает того, чтобы находиться здесь. Все дело в том, что без нее здесь было бы пусто...");

            $mediaPost->translate('en')->setTitle("Media Head$i");
            $mediaPost->translate('en')->setSubtitle("Lorem ipsum dolor sit amet for Post$i");
            $mediaPost->translate('en')->setText($this->loremIpsum);

            $mediaPost->mergeNewTranslations();

            $manager->persist($post);
            $manager->persist($mediaPost);
        }
        $manager->flush();
    }
}

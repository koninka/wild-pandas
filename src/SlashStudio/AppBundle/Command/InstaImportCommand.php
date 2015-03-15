<?php
namespace SlashStudio\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use SlashStudio\AppBundle\Entity\InstagramPost;
use SlashStudio\AppBundle\Entity\InstagramPhoto;

class InstaImportCommand extends ContainerAwareCommand
{
    const DEFAULT_IMPORT_COUNT = 8;
    protected function configure()
    {
        $this
            ->setName('instagram:import')
            ->setDescription('import photos from instagram')
            ->addArgument(
                'count',
                InputArgument::OPTIONAL,
                'Count of recent instagram photos you want to import'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $cnt = $input->getArgument('count');
        $cnt = $cnt ? intval($cnt) : self::DEFAULT_IMPORT_COUNT;

        $instagramApi = $this->getContainer()->get('instaphp');
        $instagramApi->setAccessToken(
            $this->getContainer()->getParameter('instagram_api_access_token')
        );
        $response = $instagramApi->Users->Recent('self');
        if (!$response) {
            $output->writeln('Response is empty!');
            return;
        }
        if ($response->error) {
            $output->writeln('Error occured!');
            $output->writeln($response->error->message);
            return;
        }
        $data = $response->data;
        $recentPosts = [];
        $i = 0;
        $imgCnt = 0;
        while (true) {
            if (count($data) <= $i || $cnt <= $imgCnt) {
                break;
            }
            $postResponse = $data[$i];
            if ($postResponse->type != 'image') {
                $i++;
                continue;
            }
            $post = new InstagramPost();

            $postTime = new \DateTime();
            $postTime->setTimestamp(intval($postResponse->created_time));
            $post->setPostTime($postTime);
            $post->setLink($postResponse->link);

            $imagesResponse= $postResponse->images;

            $lrResponse = $imagesResponse->low_resolution;

            $lr = new InstagramPhoto();
            $lr->setUrl($lrResponse->url);
            $lr->setWidth(intval($lrResponse->width));
            $lr->setHeight(intval($lrResponse->height));

            $srResponse = $imagesResponse->standard_resolution;

            $sr = new InstagramPhoto();
            $sr->setUrl($srResponse->url);
            $sr->setWidth(intval($srResponse->width));
            $sr->setHeight(intval($srResponse->height));

            $thumbnailResponse = $imagesResponse->thumbnail;

            $thumbnail = new InstagramPhoto();
            $thumbnail->setUrl($thumbnailResponse->url);
            $thumbnail->setWidth(intval($thumbnailResponse->width));
            $thumbnail->setHeight(intval($thumbnailResponse->height));

            $post->setLowResolution($lr);
            $post->setStandardResolution($sr);
            $post->setThumbnail($thumbnail);
            $recentPosts[intval($postResponse->created_time)] = $post;
            $imgCnt++;
            $i++;
        }
        foreach($recentPosts as $time => $post) {
            echo "$time -> " . $post->getLink() . "\n";
        }
        echo "\n\n";
        $this->getContainer()
             ->get('doctrine')
             ->getManager()
             ->getRepository('SlashStudioAppBundle:InstagramPost')
             ->synchronize($recentPosts);
    }
}
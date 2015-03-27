<?php
namespace SlashStudio\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use SlashStudio\AppBundle\Entity\GoogleEvent;
// use SlashStudio\AppBundle\Entity\InstagramPost;
// use SlashStudio\AppBundle\Entity\InstagramPhoto;

class GoogleCalendarImportCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('google:calendar:import')
            ->setDescription('import calendar events from google calendar')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $soonestEvent = $this->getContainer()->get('google.helper')->getSoonEvent();
        if ($soonestEvent == null) {
            return;
        }
        $repo = $this->getContainer()->get('doctrine')->getRepository('SlashStudioAppBundle:GoogleEvent');
        $em = $this->getContainer()->get('doctrine')->getManager();
        $items = $repo->findAll();
        if (!count($items)) {
            $item = new GoogleEvent();
        } else {
            $item = $items[0];
        }
        $item->setExecDate(new \DateTime($soonestEvent['start']));
        $item->setSummary($soonestEvent['summary']);
        if (!count($items)) {
            $em->persist($item);
        } else {
            $em->merge($item);
        }
        $em->flush();
        $output->writeln("<info>Event $soonestEvent[summary] added</info>");
    }
}
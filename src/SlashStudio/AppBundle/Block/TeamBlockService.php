<?php
namespace SlashStudio\AppBundle\Block;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

use Sonata\BlockBundle\Block\BlockContextInterface;

use Sonata\AdminBundle\Admin\Pool;
use Sonata\AdminBundle\Block\AdminListBlockService;

class TeamBlockService extends AdminListBlockService
{
    private $manager;

    public function __construct($name, EngineInterface $templating, Pool $pool, EntityManager $manager)
    {
        parent::__construct($name, $templating, $pool);
        $this->manager = $manager;
    }

    public function getName()
    {
        return 'My team block';
    }

    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'url'      => false,
            'title'    => 'Insert the rss title',
            'template' => 'SlashStudioAppBundle:Block:block_team.html.twig',
        ));
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $dashboardGroups = $this->pool->getDashboardGroups();

        $admin = null;
        if (!empty($dashboardGroups['team'])) {
            foreach ($dashboardGroups['team']['items'] as $item) {
                if ($item->getCode() == 'sonata.admin.team') {
                    $admin = $item;
                    break;
                }
            }
        }

        $team = $this->manager->getRepository('SlashStudioAppBundle:Team')->findOneBy([]);

        return $this->renderPrivateResponse($blockContext->getTemplate(), [
            'admin'    => $admin,
            'team'     => $team,
            'block'    => $blockContext->getBlock(),
            'settings' => $blockContext->getSettings(),
        ], $response);
    }

//    public function execute(BlockContextInterface $blockContext, Response $response = null)
//    {
//        return $this->renderResponse($blockContext->getTemplate(), array(
//            'block'     => $blockContext->getBlock(),
//            'settings'  => $blockContext->getSettings(),
//        ), $response);
//    }
}
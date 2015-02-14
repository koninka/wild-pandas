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
            'amount'   => 4,
            'template' => 'SlashStudioAppBundle:Block:block_team.html.twig',
        ));
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $dashboardGroups = $this->pool->getDashboardGroups();

        $admins = ['team' => null, 'achievement' => null];
        $codes = ['sonata.admin.achievement' => 'achievement', 'sonata.admin.team' => 'team'];
        if (!empty($dashboardGroups['team'])) {
            foreach ($dashboardGroups['team']['items'] as $item) {
                foreach ($codes as $c => $admin) {
                    if ($item->getCode() == $c) {
                        $admins[$admin] = $item;
                    }
                }
            }
        }

        $settings = $blockContext->getSettings();

        return $this->renderPrivateResponse($blockContext->getTemplate(), [
            'admins'       => $admins,
            'team'         => $this->manager->getRepository('SlashStudioAppBundle:Team')->findOneBy([]),
            'block'        => $blockContext->getBlock(),
            'settings'     => $settings,
            'achievements' => $this->manager->getRepository('SlashStudioAppBundle:Achievement')->findBy([], ['name' => 'ASC'], $settings['amount']),
        ], $response);
    }
}

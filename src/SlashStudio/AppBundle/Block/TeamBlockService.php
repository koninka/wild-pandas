<?php
namespace SlashStudio\AppBundle\Block;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sonata\BlockBundle\Block\BlockContextInterface;

class TeamBlockService extends MyBaseAdminListBlock
{
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'amount'   => 4,
            'template' => 'SlashStudioAppBundle:Block:block_team.html.twig',
        ));
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $admins = $this->getAdmins(
            'team',
            ['team', 'achievement'],
            ['sonata.admin.achievement' => 'achievement', 'sonata.admin.team' => 'team']
        );

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

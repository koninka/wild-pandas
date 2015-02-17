<?php
namespace SlashStudio\AppBundle\Block;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sonata\BlockBundle\Block\BlockContextInterface;

class CheerleaderBlock extends MyBaseAdminListBlock
{
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'amount'   => 4,
            'template' => 'SlashStudioAppBundle:Block:block_cheerleader.html.twig',
        ));
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $admins = $this->getAdmins(
            'admin.cheerleader',
            ['team', 'cheerleaders'],
            ['sonata.admin.cheerleader_team' => 'team', 'sonata.admin.cheerleaders' => 'cheerleaders']
        );

        $settings = $blockContext->getSettings();

        return $this->renderPrivateResponse($blockContext->getTemplate(), [
            'admins'       => $admins,
            'team'         => $this->manager->getRepository('SlashStudioAppBundle:CheerleaderTeam')->getShortInfo(),
            'block'        => $blockContext->getBlock(),
            'settings'     => $settings,
            'cheerleaders' => $this->manager->getRepository('SlashStudioAppBundle:Cheerleader')->getAll($settings['amount']),
        ], $response);
    }
}

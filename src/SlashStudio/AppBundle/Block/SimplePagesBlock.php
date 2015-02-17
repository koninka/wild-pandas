<?php
namespace SlashStudio\AppBundle\Block;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sonata\BlockBundle\Block\BlockContextInterface;

class SimplePagesBlock extends MyBaseAdminListBlock
{
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'amount'   => 4,
            'template' => 'SlashStudioAppBundle:Block:block_simple_pages.html.twig',
        ));
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $admins = $this->getAdmins(
            'admin.pages',
            ['simple_pages'],
            ['sonata.admin.simple_page' => 'simple_pages']
        );

        $settings = $blockContext->getSettings();

        return $this->renderPrivateResponse($blockContext->getTemplate(), [
            'admin'    => $admins['simple_pages'],
            'pages'    => $this->manager->getRepository('SlashStudioAppBundle:SimplePage')->getAll(),
            'block'    => $blockContext->getBlock(),
            'settings' => $settings,
        ], $response);
    }
}

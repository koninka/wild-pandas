<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();

        return $this->render('SlashStudioAppBundle:App:index.html.twig', [
            'team'        => $manager->getRepository('SlashStudioAppBundle:Team')->getInfo(),
            'posts'       => $manager->getRepository('SlashStudioAppBundle:Post')->getPostsForMainPage(),
            'slides'      => $manager->getRepository('SlashStudioAppBundle:Slide')->findBy([], ['displayOrder' => 'ASC']),
            'players'     => $manager->getRepository('SlashStudioAppBundle:Player')->findAll(),
            'products'    => $manager->getRepository('SlashStudioAppBundle:Product')->getProductsForMainPage(),
            'partnership' => $manager->getRepository('SlashStudioAppBundle:Partnership')->getAll(),
        ]);
    }

    public function partnershipAction()
    {
        return $this->render('SlashStudioAppBundle:App:partnership.html.twig', [
        ]);
    }
}

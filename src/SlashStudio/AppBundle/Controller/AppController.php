<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();

        return $this->render('SlashStudioAppBundle:App:index.html.twig', [
            'slides'   => $manager->getRepository('SlashStudioAppBundle:Slide')->findBy([], ['displayOrder' => 'ASC']),
            'players'  => $manager->getRepository('SlashStudioAppBundle:Player')->findAll(),
            'products' => $manager->getRepository('SlashStudioAppBundle:Product')->getProductsForMainPage(),
        ]);
    }

    public function partnershipAction()
    {
        return $this->render('SlashStudioAppBundle:App:partnership.html.twig', [
        ]);
    }
}

<?php

namespace SlashStudio\AppBundle\Controller;

use SlashStudio\AppBundle\DBAL\StructureEnumType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();

        return $this->render('SlashStudioAppBundle:App:index.html.twig', [
            'team'        => $manager->getRepository('SlashStudioAppBundle:Team')->getInfo(),
            'cl_team'     => $manager->getRepository('SlashStudioAppBundle:CheerleaderTeam')->getInfo(),
            'posts'       => $manager->getRepository('SlashStudioAppBundle:Post')->getPosts(true),
            'slides'      => $manager->getRepository('SlashStudioAppBundle:Slide')->getSlides(),
            'players'     => $manager->getRepository('SlashStudioAppBundle:Player')->getPlayers(StructureEnumType::ST_BASIC),
            'products'    => $manager->getRepository('SlashStudioAppBundle:Product')->getProducts(true),
            'partnership' => $manager->getRepository('SlashStudioAppBundle:Partnership')->getAll(),
        ]);
    }

    public function partnershipAction()
    {
        return $this->render('SlashStudioAppBundle:App:partnership.html.twig', [
        ]);
    }
}

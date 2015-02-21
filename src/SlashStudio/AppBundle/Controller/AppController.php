<?php

namespace SlashStudio\AppBundle\Controller;

use SlashStudio\AppBundle\DBAL\StructureEnumType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    const POSTS_ON_PARTNERSHIP_AMOUNT = 2;

    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();

        return $this->render('SlashStudioAppBundle:App:index.html.twig', [
            'team'        => $manager->getRepository('SlashStudioAppBundle:Team')->getInfo(),
            'cl_team'     => $manager->getRepository('SlashStudioAppBundle:CheerleaderTeam')->getInfo(),
            'posts'       => $manager->getRepository('SlashStudioAppBundle:Post')->getPostsForMainPage(),
            'slides'      => $manager->getRepository('SlashStudioAppBundle:Slide')->getSlides(),
            'players'     => $manager->getRepository('SlashStudioAppBundle:Player')->getPlayers(StructureEnumType::ST_BASIC),
            'products'    => $manager->getRepository('SlashStudioAppBundle:Product')->getProductsForMainPage(),
            'partnership' => $manager->getRepository('SlashStudioAppBundle:Partnership')->getAll(),
        ]);
    }

    public function partnershipAction()
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:Post');

        return $this->render('SlashStudioAppBundle:App:partnership.html.twig', [
            'posts' => $repo->getLimitedPosts(static::POSTS_ON_PARTNERSHIP_AMOUNT)
        ]);
    }
}

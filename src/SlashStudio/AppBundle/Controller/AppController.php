<?php

namespace SlashStudio\AppBundle\Controller;

use SlashStudio\AppBundle\DBAL\StructureEnumType;
use SlashStudio\AppBundle\Entity\TeamProposalMembership;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AppController extends Controller
{
    const VIDEOS_ON_MAIN_AMOUNT       = 2;
    const POSTS_ON_PARTNERSHIP_AMOUNT = 2;

    public function indexAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $teamRepo = $manager->getRepository('SlashStudioAppBundle:Team');
        $membership = new TeamProposalMembership();
        $joinForm = $this->createForm('team_proposal_membership', $membership);
        $joinForm->handleRequest($request);
        if ($joinForm->isValid()) {
            echo 'form is valid!';
        }

        return $this->render('SlashStudioAppBundle:App:index.html.twig', [
            'join_form'   => $joinForm->createView(),
            'team'        => $teamRepo->getInfo(),
            'videos'      => $teamRepo->getVideoForTeam(static::VIDEOS_ON_MAIN_AMOUNT),
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

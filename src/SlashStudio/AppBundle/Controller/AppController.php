<?php

namespace SlashStudio\AppBundle\Controller;

use SlashStudio\AppBundle\DBAL\StructureEnumType;
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
        $joinForm = $this->createForm('team_proposal_membership', null, ['main_page' => true]);
        $joinForm->handleRequest($request);
        if ($joinForm->isValid()) {
            $membershipProposal = $joinForm->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($membershipProposal);
            $em->flush();

            $this->get('my_mailer')->sendTeamJoinEmails($membershipProposal, $teamRepo->getManagerEmail());


            $request->getSession()->getFlashBag()->add(
                'notice',
                'team.join.success'
            );

            return $this->redirect($this->generateUrl('slash_app_mainpage'));
        }

        return $this->render('SlashStudioAppBundle:App:index.html.twig', [
            'join_form'    => $joinForm->createView(),
            'team'         => $teamRepo->getInfo(),
            'ads'          => $manager->getRepository('SlashStudioAppBundle:Ad')->getAll(),
            'videos'       => $teamRepo->getVideoForTeam(static::VIDEOS_ON_MAIN_AMOUNT),
            'cl_team'      => $manager->getRepository('SlashStudioAppBundle:CheerleaderTeam')->getInfo(),
            'posts'        => $manager->getRepository('SlashStudioAppBundle:Post')->getPostsForMainPage(),
            'slides'       => $manager->getRepository('SlashStudioAppBundle:Slide')->getSlides(),
            'cheerleaders' => $manager->getRepository('SlashStudioAppBundle:Cheerleader')->getAll(8),
            'players'      => $manager->getRepository('SlashStudioAppBundle:Player')->getPlayers(StructureEnumType::ST_BASIC),
            'products'     => $manager->getRepository('SlashStudioAppBundle:Product')->getProductsForMainPage(),
            'partnership'  => $manager->getRepository('SlashStudioAppBundle:Partnership')->getAll(),
            'instagram'   => $manager->getRepository('SlashStudioAppBundle:InstagramPost')->getLast(8),
        ]);
    }

    public function partnershipAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:Post');

        return $this->render('SlashStudioAppBundle:App:partnership.html.twig', [
            'posts'     => $manager->getRepository('SlashStudioAppBundle:Post')->getLimitedPosts(static::POSTS_ON_PARTNERSHIP_AMOUNT),
            'instagram' => $manager->getRepository('SlashStudioAppBundle:InstagramPost')->getLast(4)
        ]);
    }
}

<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CheerleaderController extends Controller
{
    const CHEERLEADERS_PER_PAGE = 9;
    const MAX_VIDEOS_ON_PAGE = 3;

    public function listAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $page = $request->query->get('page', 1);

        $joinForm = $this->createForm('cheerleader_team_proposal_membership');
        $joinForm->handleRequest($request);
        if ($joinForm->isValid()) {
            $membershipProposal = $joinForm->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($membershipProposal);
            $em->flush();

            $this->get('my_mailer')->sendCheerleaderTeamJoinEmails($membershipProposal, $manager->getRepository('SlashStudioAppBundle:Team')->getManagerEmail());

            $request->getSession()->getFlashBag()->add(
                'notice',
                'team.join.success'
            );

            return $this->redirect($this->generateUrl('slash_app_chearleaders', ['page' => $page]));
        }

        $pagination = $this->get('knp_paginator')->paginate(
            $manager->getRepository('SlashStudioAppBundle:Cheerleader')->getAllQB(),
            $request->query->get('page', 1),
            static::CHEERLEADERS_PER_PAGE
        );

        $teamRepo = $manager->getRepository('SlashStudioAppBundle:CheerleaderTeam');

        return $this->render('SlashStudioAppBundle:Cheerleader:list.html.twig', [
            'team'       => $teamRepo->getInfo(),
            'join_form'  => $joinForm->createView(),
            'videos'     => $teamRepo->getVideoForTeam(static::MAX_VIDEOS_ON_PAGE),
            'pagination' => $pagination,
        ]);
    }
}

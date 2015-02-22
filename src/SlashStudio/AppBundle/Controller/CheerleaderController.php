<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CheerleaderController extends Controller
{
    const CHEERLEADERS_PER_PAGE = 3;
    const MAX_VIDEOS_ON_PAGE = 4;

    public function listAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $pagination = $this->get('knp_paginator')->paginate(
            $manager->getRepository('SlashStudioAppBundle:Cheerleader')->getAllQB(),
            $request->query->get('page', 1),
            static::CHEERLEADERS_PER_PAGE
        );
        $teamRepo = $manager->getRepository('SlashStudioAppBundle:CheerleaderTeam');

        return $this->render('SlashStudioAppBundle:Cheerleader:list.html.twig', [
            'team'       => $teamRepo->getInfo(),
            'videos'     => $teamRepo->getVideoForTeam(static::MAX_VIDEOS_ON_PAGE),
            'pagination' => $pagination,
        ]);
    }
}

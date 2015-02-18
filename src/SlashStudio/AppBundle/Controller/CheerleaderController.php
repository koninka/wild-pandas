<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CheerleaderController extends Controller
{
    const CHEERLEADERS_PER_PAGE = 3;

    public function listAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $pagination = $this->get('knp_paginator')->paginate(
            $manager->getRepository('SlashStudioAppBundle:Cheerleader')->getAllQB(),
            $request->query->get('page', 1),
            static::CHEERLEADERS_PER_PAGE
        );

        return $this->render('SlashStudioAppBundle:Cheerleader:list.html.twig', [
            'team' => $manager->getRepository('SlashStudioAppBundle:CheerleaderTeam')->getInfo(),
            'pagination' => $pagination,
        ]);
    }
}

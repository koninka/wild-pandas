<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CheerleaderController extends Controller
{
    public function listAction()
    {
        $manager = $this->getDoctrine()->getManager();

        return $this->render('SlashStudioAppBundle:Cheerleader:list.html.twig', [
            'team' => $manager->getRepository('SlashStudioAppBundle:CheerleaderTeam')->getInfo(),
            'cheerleaders' => $manager->getRepository('SlashStudioAppBundle:Cheerleader')->getAll(),
        ]);
    }
}

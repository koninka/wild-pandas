<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TeamController extends Controller
{
    public function playersAction()
    {
        return $this->render('SlashStudioAppBundle:Team:players.html.twig', [

        ]);
    }

    public function infoAction($action)
    {
        return $this->render('SlashStudioAppBundle:Team:info.html.twig', [
            'header' => $this->get('translator')->trans('navigation.' . $action, [], 'navigation'),
        ]);
    }

    public function joinAction()
    {
        return $this->render('SlashStudioAppBundle:Team:join.html.twig', [

        ]);
    }
}

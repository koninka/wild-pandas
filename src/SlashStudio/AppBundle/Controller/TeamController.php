<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SlashStudio\AppBundle\DBAL\StructureEnumType;

class TeamController extends Controller
{
    public function playersAction()
    {
        return $this->render('SlashStudioAppBundle:Team:players.html.twig', [
            'players' => $this->getDoctrine()->getRepository('SlashStudioAppBundle:Player')->getPlayers(StructureEnumType::ST_BASIC),
        ]);
    }

    public function infoAction($action)
    {
        $page = $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:SimplePage')->getPage($action);
        if (empty($page)) {
            $this->createNotFoundException();
        }

        return $this->render('SlashStudioAppBundle:Team:info.html.twig', [
            'page'   => $page,
            'header' => $this->get('translator')->trans('navigation.' . $action, [], 'navigation'),
        ]);
    }

    public function joinAction()
    {
        return $this->render('SlashStudioAppBundle:Team:join.html.twig', [

        ]);
    }
}

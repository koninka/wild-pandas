<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SlashStudio\AppBundle\DBAL\StructureEnumType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\Types\Type;

class TeamController extends Controller
{
    const PLAYERS_PER_PAGE = 30;

    public function playersAction(Request $request)
    {
        $structure = $request->query->get('s');
        $structure = !empty(Type::getType('structureEnumType')->getChoices()[$structure]) ? $structure : StructureEnumType::ST_BASIC;
        $pagination = $this->get('knp_paginator')->paginate(
            $this->getDoctrine()->getRepository('SlashStudioAppBundle:Player')->getPlayersQuery($structure),
            $request->query->get('page', 1)/*page number*/,
            static::PLAYERS_PER_PAGE
        );

        return $this->render('SlashStudioAppBundle:Team:players.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    public function infoAction($action)
    {
        $page = $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:SimplePage')->getPage($action);
        if (empty($page)) {
            $this->createNotFoundException();
        }
        $this->container->get('my_seo')->addMeta($page);

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

<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SlashStudio\AppBundle\DBAL\StructureEnumType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\Types\Type;

class TeamController extends Controller
{
    public function playersAction(Request $request)
    {
        $structure = $request->query->get('s');
        $structure = !empty(Type::getType('structureEnumType')->getChoices()[$structure]) ? $structure : StructureEnumType::ST_BASIC;

        return $this->render('SlashStudioAppBundle:Team:players.html.twig', [
            'players' => $this->getDoctrine()->getRepository('SlashStudioAppBundle:Player')->getPlayers($structure),
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

<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    public function indexAction()
    {
        return $this->render('SlashStudioAppBundle:App:index.html.twig', [
            'players' => $this->getDoctrine()->getEntityManager()->getRepository('SlashStudioAppBundle:Player')->findAll()
        ]);
    }
}

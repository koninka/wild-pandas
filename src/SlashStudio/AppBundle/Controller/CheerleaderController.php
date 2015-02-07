<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CheerleaderController extends Controller
{
    public function listAction()
    {
        return $this->render('SlashStudioAppBundle:Cheerleader:list.html.twig', [

        ]);
    }
}

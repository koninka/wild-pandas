<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MediaController extends Controller
{
    public function photoAction()
    {
        return $this->render('SlashStudioAppBundle:Media:photo.html.twig', [

        ]);
    }

    public function videoAction()
    {
        return $this->render('SlashStudioAppBundle:Media:video.html.twig', [
        ]);
    }

    public function aboutAction()
    {
        return $this->render('SlashStudioAppBundle:Media:about.html.twig', [
            'posts' => $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:MediaPost')->getMedia()
        ]);
    }
}

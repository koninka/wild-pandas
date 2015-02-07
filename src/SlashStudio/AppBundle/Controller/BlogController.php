<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    public function listAction()
    {
        return $this->render('SlashStudioAppBundle:Blog:list.html.twig', [
            'posts' => [],
        ]);
    }

    public function showAction($id)
    {
        $post = null;
        if (empty($post)) {
            throw $this->createNotFoundException();
        }

        return $this->render('SlashStudioAppBundle:Product:show.html.twig', [
            'post' => [],
        ]);
    }
}

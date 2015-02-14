<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    public function listAction()
    {
        return $this->render('SlashStudioAppBundle:Blog:list.html.twig', [
            'posts' => $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:Post')->getPosts(),
        ]);
    }

    public function showAction($id)
    {
        $post = $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:Post')->getPostInfo($id);
        if (empty($post)) {
            throw $this->createNotFoundException();
        }

        return $this->render('SlashStudioAppBundle:Blog:show.html.twig', [
            'post' => $post,
        ]);
    }
}

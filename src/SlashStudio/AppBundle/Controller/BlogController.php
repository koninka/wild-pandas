<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    const POSTS_PER_PAGE = 9;

    public function listAction(Request $request)
    {
        $pagination = $this->get('knp_paginator')->paginate(
            $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:Post')->getPostsQB(),
            $request->query->get('page', 1)/*page number*/,
            static::POSTS_PER_PAGE
        );

        return $this->render('SlashStudioAppBundle:Blog:list.html.twig', [
            'pagination' => $pagination,
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

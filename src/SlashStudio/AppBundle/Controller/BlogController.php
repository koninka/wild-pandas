<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    const POSTS_PER_PAGE     = 9;
    const OTHER_POSTS_AMOUNT = 2;

    public function listAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $pagination = $this->get('knp_paginator')->paginate(
            $manager->getRepository('SlashStudioAppBundle:Post')->getPostsQB(),
            $request->query->get('page', 1)/*page number*/,
            static::POSTS_PER_PAGE
        );

        return $this->render('SlashStudioAppBundle:Blog:list.html.twig', [
            'ads' => $manager->getRepository('SlashStudioAppBundle:Ad')->getAll(),
            'pagination' => $pagination,
        ]);
    }

    public function showAction($id)
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:Post');
        $post = $repo->getPostInfo($id);
        if (empty($post)) {
            throw $this->createNotFoundException();
        }
        $this->container->get('my_seo')->addMeta($post);

        return $this->render('SlashStudioAppBundle:Blog:show.html.twig', [
            'post' => $post,
            'other_posts' => $repo->getOtherPosts($post, static::OTHER_POSTS_AMOUNT),
            'instagram'  => $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:InstagramPost')->getLast(4),
        ]);
    }
}

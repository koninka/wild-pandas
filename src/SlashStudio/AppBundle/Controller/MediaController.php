<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MediaController extends Controller
{
    const PHOTO_PER_PAGE       = 1;
    const OTHER_POSTS_AMOUNT   = 2;
    const VIDEOS_PER_PAGE      = 2;
    const MEDIA_POSTS_PER_PAGE = 9;

    public function photoAction(Request $request)
    {
        // $pagination = $this->get('knp_paginator')->paginate(
        //     $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:Team')->getPhotoQuery(),
        //     $request->query->get('page', 1),
        //     static::PHOTO_PER_PAGE
        // );

        return $this->render('SlashStudioAppBundle:Media:photo.html.twig', [
            'pagination' => [],
        ]);
    }

    public function videoAction(Request $request)
    {
        $pagination = $this->get('knp_paginator')->paginate(
            $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:Team')->getVideosQBForPaginating(),
            $request->query->get('page', 1)/*page number*/,
            static::VIDEOS_PER_PAGE
        );

        return $this->render('SlashStudioAppBundle:Media:video.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    public function aboutAction(Request $request)
    {
        $pagination = $this->get('knp_paginator')->paginate(
            $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:MediaPost')->getMediaPostQB(),
            $request->query->get('page', 1),
            static::MEDIA_POSTS_PER_PAGE
        );

        return $this->render('SlashStudioAppBundle:Media:about.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    public function showAction($id)
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:MediaPost');
        $post = $repo->getPostInfo($id);
        if (null === $post) {
            throw $this->createNotFoundException();
        }
        $this->container->get('my_seo')->addMeta($post);

        return $this->render('SlashStudioAppBundle:Media:show.html.twig', [
            'post' => $post,
            'other_posts' => $repo->getOtherPosts($post, static::OTHER_POSTS_AMOUNT),
        ]);
    }
}

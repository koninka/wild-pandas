<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MediaController extends Controller
{
    const PHOTO_PER_PAGE       = 1;
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

    public function videoAction()
    {
        return $this->render('SlashStudioAppBundle:Media:video.html.twig', [
        ]);
    }

    public function aboutAction(Request $request)
    {
        $pagination = $this->get('knp_paginator')->paginate(
            $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:MediaPost')->getMediaQuery(),
            $request->query->get('page', 1),
            static::MEDIA_POSTS_PER_PAGE
        );

        return $this->render('SlashStudioAppBundle:Media:about.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    public function showAction($id)
    {
        $post = $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:MediaPost')->getPostInfo($id);
        if (empty($post)) {
            throw $this->createNotFoundException();
        }
        $this->container->get('my_seo')->addMeta($post);

        return $this->render('SlashStudioAppBundle:Media:show.html.twig', [
            'post' => $post,
        ]);
    }
}

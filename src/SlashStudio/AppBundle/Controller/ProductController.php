<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    const PRODUCTS_PER_PAGE = 12;
    const OTHER_PRODUCTS_COUNT = 4;

    public function listAction(Request $request)
    {
        $pagination = $this->get('knp_paginator')->paginate(
            $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:Product')->getProductsQB(),
            $request->query->get('page', 1)/*page number*/,
            static::PRODUCTS_PER_PAGE
        );

        return $this->render('SlashStudioAppBundle:Product:list.html.twig', [
             'pagination' => $pagination,
        ]);
    }

    public function showAction($id)
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:Product');
        $product = $repo->getProductInfo($id);
        if (empty($product)) {
            throw $this->createNotFoundException($this->get('translator')->trans('product.not_found'));
        }
        $this->container->get('my_seo')->addMeta($product);
        return $this->render('SlashStudioAppBundle:Product:show.html.twig', [
            'product' => $product,
            'other_products' => $repo->getOtherProducts($product, static::OTHER_PRODUCTS_COUNT),
        ]);
    }
}

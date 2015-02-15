<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    public function listAction()
    {
        return $this->render('SlashStudioAppBundle:Product:list.html.twig', [
             'products' => $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:Product')->getProducts(),
        ]);
    }

    public function showAction($id)
    {
        $product = $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:Product')->getProductInfo($id);
        if (empty($product)) {
            throw $this->createNotFoundException($this->get('translator')->trans('product.not_found'));
        }

        return $this->render('SlashStudioAppBundle:Product:show.html.twig', [
            'product' => $product,
        ]);
    }
}

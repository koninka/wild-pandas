<?php

namespace SlashStudio\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();

        return $this->render('SlashStudioAppBundle:App:index.html.twig', [
            'players' => $manager->getRepository('SlashStudioAppBundle:Player')->findAll(),
            'products' => $manager->getRepository('SlashStudioAppBundle:Product')->getProductsForMainPage(),
        ]);
    }

    public function productsAction()
    {
        return $this->render('SlashStudioAppBundle:App:products.html.twig', [
             'products' => $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:Product')->findBy([], ['name' => 'ASC']),
        ]);
    }

    public function productShowAction($id)
    {
        $product = $this->getDoctrine()->getManager()->getRepository('SlashStudioAppBundle:Product')->getProductInfo($id);
        if (empty($product)) {
            throw $this->createNotFoundException($this->get('translator')->trans('product.not_found'));
        }

        return $this->render('SlashStudioAppBundle:App:product_show.html.twig', [
            'product' => $product,
        ]);
    }
}

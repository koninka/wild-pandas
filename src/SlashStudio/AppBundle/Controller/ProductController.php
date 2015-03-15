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

    public function showAction(Request $request, $id)
    {
        $manager = $this->getDoctrine()->getManager();
        $productRepo = $manager->getRepository('SlashStudioAppBundle:Product');
        $product = $productRepo->getProductInfo($id);
        if ($product === null) {
            throw $this->createNotFoundException($this->get('translator')->trans('product.not_found'));
        }

        $orderForm = $this->createForm('proposal_purchase_product');
//        $orderForm->get('product')->setData($product);

        $orderForm->handleRequest($request);

        if ($orderForm->isValid()) {
            $productProposal = $orderForm->getData();
            $productProposal->setProduct($product);

            $em = $this->getDoctrine()->getManager();
            $em->persist($productProposal);
            $em->flush();

            $this->get('my_mailer')->sendOrderEmails($productProposal, $product, $manager->getRepository('SlashStudioAppBundle:Team')->getManagerEmail());


            $request->getSession()->getFlashBag()->add(
                'notice',
                'product.order.success'
            );

            return $this->redirect($this->generateUrl('slash_app_product_show', ['id' => $id]));
        } 

        $valid = 'valid';

        if ($orderForm->isSubmitted() && !$orderForm->isValid()) {
            $valid = 'error';
        }

        $this->container->get('my_seo')->addMeta($product);

        return $this->render('SlashStudioAppBundle:Product:show.html.twig', [
            'valid' => $valid,
            'product' => $product,
            'order_form' => $orderForm->createView(),
            'other_products' => $productRepo->getOtherProducts($product, static::OTHER_PRODUCTS_COUNT),
        ]);
    }
}

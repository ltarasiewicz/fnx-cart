<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Product;
use AppBundle\Entity\Category;

class DefaultController extends Controller
{
    /**
     * @Route(
     *      "/{page}",
     *      name="homepage",
     *      defaults = {"page" = 1},
     *      requirements = {"page" = "\d+"}
     * )
     * @Template()
     */
    public function indexAction($page)
    {

        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Product')
            ->findAllOrderedByName();
        $categories = $em->getRepository('AppBundle:Category')
            ->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $products,
            $page,
            6
        );

        return [
            'products' => $products,
            'productsCount' => $this->get('cart')->getProductsCount(),
            'categories'    => $categories,
            'pagination'    => $pagination,
        ];
    }

    /**
     * @Route(
     *      "/category/{id}/{page}",
     *      name="filter_products",
     *      defaults = {"page" = 1},
     *      requirements = {"page" = "\d+"}
     * )
     */
    public function filterProductsAction(Category $category, $page)
    {

        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Product')
            ->findByCategory($category->getId());
        $categories = $em->getRepository('AppBundle:Category')
            ->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $products,
            $page,
            6
        );

        return $this->render('AppBundle:Default:index.html.twig', [
            'products' => $products,
            'productsCount' => $this->get('cart')->getProductsCount(),
            'categories' => $categories,
            'current_category' => $category,
            'pagination'    =>  $pagination,
        ]);

    }


    /**
     * @Route("product/{id}", name="single_product")
     * @Template()
     */
    public function singleProductAction(Product $product)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->find($product->getId());

        return  [
            'product' => $product,
            'productsCount' => $this->get('cart')->getProductsCount(),
        ];

    }

    /**
     * @Route(
     *      "/add-product/{id}",
     *      name="add_product",
     *      requirements={"id"="\d+"},
     * )
     */
    public function addProductAction(Product $product)
    {
        $productId = $product->getId();
        $cart = $this->get('cart');
        $cart->addProduct($productId);

        return $this->redirectToRoute('homepage', array(), 301);

    }
}

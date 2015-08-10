<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;

class CartController extends Controller
{
    /**
     * @Route("/cart", name="cart_view")
     * @Template()
     */
    public function indexAction()
    {
        $productIds = $this->get('cart')->getAllProducts();

        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Product')
            ->findById($productIds);


        return [
            'products' => $products,
            'productsCount' => $this->get('cart')->getProductsCount(),
            'total' => $this->get('cart')->getTotalPrice(),
        ];
    }

    /**
     * @Route("/remove/{id}", name="remove_from_cart")
     * @Template()
     */
    public function removeFromCartAction(Product $product)
    {
        $this->get('cart')->removeProduct($product->getId());

        return $this->redirectToRoute('cart_view', array(), 301);
    }

}

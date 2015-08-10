<?php
/**
 * Created by PhpStorm.
 * User: ltarasiewicz
 * Date: 8/7/15
 * Time: 7:21 PM
 */

namespace AppBundle\Lib;

use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManager;

class Cart
{
    private $requestStack;
    private $entityManager;

    public function __construct(RequestStack $requestStack, EntityManager $entityManager)
    {
        $this->requestStack = $requestStack;
        $this->entityManager = $entityManager;
    }

    public function addProduct($productId)
    {
        $productsInCart = [];

        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();

        if($session->has('products')) {
            $productsInCart = $session->get('products');
        }
        $productsInCart[] = $productId;

        $session->set('products', $productsInCart);
    }

    public function removeProduct($productId)
    {
        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();

        $productsInCart = $session->get('products');

        $p = $productsInCart;

        if(false !== ($key = array_search($productId, $productsInCart))) {
            unset($productsInCart[$key]);
        }
        $session->set("products", $productsInCart);

    }

    public function getProduct($productId)
    {
        return $this->session->get('products', $productId);
    }

    public function getAllProducts()
    {
        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();
        return $session->get('products');
    }

    public function getProductsCount()
    {
        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();
        $productsCount = count($session->get('products'));

        return $productsCount > 0 ? $productsCount : 0;
    }

    public function getTotalPrice()
    {

        $productIds = $this->getAllProducts();

        $query = $this->entityManager->createQuery(
            'SELECT SUM(p.price) AS total
            FROM AppBundle:Product p
            WHERE p.id IN(:productIds)'
        )->setParameter('productIds', $productIds);

        return $query->getSingleScalarResult();
    }

}
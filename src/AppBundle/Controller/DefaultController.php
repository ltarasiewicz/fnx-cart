<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use AppBundle\Entity\Category;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Product')
            ->findAllOrderedByName();
        $categories = $em->getRepository('AppBundle:Category')
            ->findAll();

        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('filter_products'))
            ->setMethod('GET')
            ->add('category', 'entity', [
                'class' => 'AppBundle:Category',
                'choice_label' => 'title',
            ])
            ->add('save', 'submit')
            ->getForm();

        return [
            'products' => $products,
            'productsCount' => $this->get('cart')->getProductsCount(),
            'categories'    => $categories,
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/category",  name="filter_products")
     */
    public function filterProductsAction(Request $request)
    {
        $categoryId = $request->query->get('form')['category'];

        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Product')
            ->findByCategory($categoryId);
        $categories = $em->getRepository('AppBundle:Category')
            ->findAll();

        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('filter_products'))
            ->setMethod('GET')
            ->add('category', 'entity', [
                'class' => 'AppBundle:Category',
                'choice_label' => 'title',
            ])
            ->add('save', 'submit')
            ->getForm();

        return $this->render('AppBundle:Default:index.html.twig', [
            'products' => $products,
            'productsCount' => $this->get('cart')->getProductsCount(),
            'categories' => $categories,
            'form' => $form->createView(),
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
        //$em = $this->getDoctrine()->getManager();
        $productId = $product->getId();
        $cart = $this->get('cart');
        $cart->addProduct($productId);

        return $this->redirectToRoute('homepage', array(), 301);

    }
}

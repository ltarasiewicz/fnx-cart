<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Product;

class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * @{@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $products = [
            'Cutlery' => [
                'price' => 120,
                'description' => 'Elegant cutlery set for every occasion',
                'thumbnail' => 'http://lorempixel.com/300/300/',
                'category' => 'kitchenware'
            ],
            'Kettle' => [
                'price' => 230,
                'description' => 'Ideal for brewing tea or coffee',
                'thumbnail' => 'http://lorempixel.com/300/300/',
                'category' => 'kitchenware'
            ],
            'Microwave' => [
                'price' => 420,
                'description' => 'Modern, eco-friendly microwave for a moder kitchen',
                'thumbnail' => 'http://lorempixel.com/300/300/',
                'category' => 'kitchenware'
            ],
            'Short skirt' => [
                'price' => 99,
                'description' => 'Sexy skirt for a crazy night out',
                'thumbnail' => 'http://lorempixel.com/300/300/',
                'category' => 'fashion'
            ],
            'Evening dress' => [
                'price' => 340,
                'description' => 'An elegant evening dress for a special occasion',
                'thumbnail' => 'http://lorempixel.com/300/300/',
                'category' => 'fashion'
            ],
            'Cashmire blouse' => [
                'price' => 210,
                'description' => 'A light and elegant blouse made of top quality cashmire',
                'thumbnail' => 'http://lorempixel.com/300/300/',
                'category' => 'fashion'
            ],
            'Lego technics' => [
                'price' => 440,
                'description' => 'Lego blocks for creative fun play',
                'thumbnail' => 'http://lorempixel.com/300/300/',
                'category' => 'toys'
            ],
            'Magnifying glass' => [
                'price' => 40,
                'description' => 'Fun idea for children playing outdoors!',
                'thumbnail' => 'http://lorempixel.com/300/300/',
                'category' => 'toys'
            ],
            'Trampoline' => [
                'price' => 540,
                'description' => 'Acrobatic equipment for children of all ages',
                'thumbnail' => 'http://lorempixel.com/300/300/',
                'category' => 'toys'
            ],
            'iPhone5' => [
                'price' => 1540,
                'description' => 'The latest iPhone straight from the Silicon Valley',
                'thumbnail' => 'http://lorempixel.com/300/300/',
                'category' => 'electronics'
            ],
            'Headset' => [
                'price' => 195,
                'description' => 'Headset for any mobile phone - drive&talk!',
                'thumbnail' => 'http://lorempixel.com/300/300/',
                'category' => 'electronics'
            ],
            'Smart watch' => [
                'price' => 510,
                'description' => 'A watch for professional and amateur sportsmen',
                'thumbnail' => 'http://lorempixel.com/300/300/',
                'category' => 'electronics'
            ],

        ];

        foreach($products as $key => $value) {
            $product = new Product();
            $product->setTitle($key);
            $product->setPrice($value['price']);
            $product->setDescription($value['description']);
            $product->setThumbnail($value['thumbnail']);
            $product->setCategory($this->getReference('category_' . $value['category']));
            $product->setCreatedAt(new \DateTime());

            $manager->persist($product);
        }

        $manager->flush();

    }

    public function getOrder()
    {
        return 1;
    }

}
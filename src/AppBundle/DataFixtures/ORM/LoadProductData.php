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
                'thumbnail' => 'http://lorempixel.com/300/300/abstract',
                'category' => 'kitchenware',
                'manufacturer' => 'Top Kitchen'
            ],
            'Kettle' => [
                'price' => 230,
                'description' => 'Ideal for brewing tea or coffee',
                'thumbnail' => 'http://lorempixel.com/300/300/city',
                'category' => 'kitchenware',
                'manufacturer' => 'Super Home'
            ],
            'Microwave' => [
                'price' => 420,
                'description' => 'Modern, eco-friendly microwave for a moder kitchen',
                'thumbnail' => 'http://lorempixel.com/300/300/people',
                'category' => 'kitchenware',
                'manufacturer' => 'Home Electronics'
            ],
            'Short skirt' => [
                'price' => 99,
                'description' => 'Sexy skirt for a crazy night out',
                'thumbnail' => 'http://lorempixel.com/300/300/transport',
                'category' => 'fashion',
                'manufacturer' => 'Top Fashion'
            ],
            'Evening dress' => [
                'price' => 340,
                'description' => 'An elegant evening dress for a special occasion',
                'thumbnail' => 'http://lorempixel.com/300/300/animals',
                'category' => 'fashion',
                'manufacturer' => 'Catwalk Ltd.'
            ],
            'Cashmire blouse' => [
                'price' => 210,
                'description' => 'A light and elegant blouse made of top quality cashmire',
                'thumbnail' => 'http://lorempixel.com/300/300/food',
                'category' => 'fashion',
                'manufacturer' => 'Best Clothes'
            ],
            'Lego technics' => [
                'price' => 440,
                'description' => 'Lego blocks for creative fun play',
                'thumbnail' => 'http://lorempixel.com/300/300/nature',
                'category' => 'toys',
                'manufacturer' => 'Lego'
            ],
            'Magnifying glass' => [
                'price' => 40,
                'description' => 'Fun idea for children playing outdoors!',
                'thumbnail' => 'http://lorempixel.com/300/300/business',
                'category' => 'toys',
                'manufacturer' => 'Educational Resources Ltd.'
            ],
            'Trampoline' => [
                'price' => 540,
                'description' => 'Acrobatic equipment for children of all ages',
                'thumbnail' => 'http://lorempixel.com/300/300/nightlife',
                'category' => 'toys',
                'manufacturer' => 'Fisher Price'
            ],
            'iPhone5' => [
                'price' => 1540,
                'description' => 'The latest iPhone straight from the Silicon Valley',
                'thumbnail' => 'http://lorempixel.com/300/300/sports',
                'category' => 'electronics',
                'manufacturer' => 'Apple'
            ],
            'Headset' => [
                'price' => 195,
                'description' => 'Headset for any mobile phone - drive&talk!',
                'thumbnail' => 'http://lorempixel.com/300/300/technics',
                'category' => 'electronics',
                'manufacturer' => 'NokiaX'
            ],
            'Smart watch' => [
                'price' => 510,
                'description' => 'A watch for professional and amateur sportsmen',
                'thumbnail' => 'http://lorempixel.com/300/300/fashion',
                'category' => 'electronics',
                'manufacturer' => 'Samsung'
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
            $product->setManufacturer($value['manufacturer']);

            $manager->persist($product);
        }

        $manager->flush();

    }

    public function getOrder()
    {
        return 1;
    }

}
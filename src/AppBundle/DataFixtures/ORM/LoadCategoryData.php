<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * @{@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $categories = ['fashion', 'kitchenware', 'toys', 'electronics'];

        foreach($categories as $singleCategory) {
            $category = new Category();
            $category->setTitle($singleCategory);
            $manager->persist($category);
            $this->addReference('category_' . $singleCategory, $category);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 0;
    }

}
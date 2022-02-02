<?php

namespace App\DataFixtures;

use App\Entity\CategoryDrink;
use App\DataFixtures\DrinkFixtures;
use App\DataFixtures\BenefitFixtures;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\IngredientFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CategoryDrinkFixtures extends Fixture
{
    public const CATEGORYDRINK = [
        'Smoothie',
        'Thé',
        'Chocolat',
        'Infusion',
        'Latte',
        'Café',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CATEGORYDRINK as $categoryName) {
            $category = new CategoryDrink();
            $category->setName($categoryName);
            $this->addReference($categoryName, $category);
            $manager->persist($category);
        }

        $manager->flush();
    }
}

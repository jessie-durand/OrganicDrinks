<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use App\DataFixtures\DrinkFixtures;
use App\DataFixtures\BenefitFixtures;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\CategoryDrinkFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class IngredientFixtures extends Fixture implements DependentFixtureInterface
{
    public const INGREDIENT = [
        ['Spiruline', 'https://www.vegalia.fr/wp-content/uploads/2016/09/spiruline-vegalia.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', ['Tonicité']],
        ['Maté', 'https://www.vegalia.fr/wp-content/uploads/2016/09/spiruline-vegalia.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', ['Relaxant']],
        ['Xocoati', 'https://www.vegalia.fr/wp-content/uploads/2016/09/spiruline-vegalia.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', ['Energie']],
        ['Thé vert', 'https://www.vegalia.fr/wp-content/uploads/2016/09/spiruline-vegalia.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', ['Detox']],
        ['Kale', 'https://www.vegalia.fr/wp-content/uploads/2016/09/spiruline-vegalia.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', ['Fortifiant']],
        ['Matcha', 'https://www.vegalia.fr/wp-content/uploads/2016/09/spiruline-vegalia.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', ['Minceur']],
        ['Gingembre', 'https://www.vegalia.fr/wp-content/uploads/2016/09/spiruline-vegalia.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', ['Detox']],
        ['Café', 'https://www.vegalia.fr/wp-content/uploads/2016/09/spiruline-vegalia.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', ['Energie']]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::INGREDIENT as $ingredientName) {
            $ingredient = new Ingredient();
            $ingredient->setName($ingredientName);
            $this->addReference($ingredientName, $ingredient);
            $ingredient->setImage($ingredientName[1]);
            $ingredient->setDescription($ingredientName[2]);
            foreach ($ingredientName[4] as $benefit) {
                $ingredient->addBenefit($this->getReference($benefit));
            }
            $manager->persist($ingredient);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            DrinkFixtures::class,
            BenefitFixtures::class,
            CategoryDrinkFixtures::class,
        ];
    }
}

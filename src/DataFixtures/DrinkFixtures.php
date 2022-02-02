<?php

namespace App\DataFixtures;

use App\Entity\Drink;
use App\DataFixtures\BenefitFixtures;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\IngredientFixtures;
use App\DataFixtures\CategoryDrinkFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class DrinkFixtures extends Fixture implements DependentFixtureInterface
{
    public const DRINK = [
        ['Maté Latte', "https://cdn.shopify.com/s/files/1/0071/0544/5955/files/Matcha_Coffee_1024x1024.jpg?v=1601756452", 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', "Smoothie", ['Maté']],
        ['Iced Matcha Latte', "https://893364.smushcdn.com/2102600/wp-content/uploads/2020/03/Smoothie-3495.jpg?lossy=1&strip=1&webp=1", 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', "Thé", ['Matcha']],
        ['Smoothie à la spiruline', "https://init4thelongrun.com/wp-content/uploads/2018/10/Magic_Chocolate_Elixir-8-of-26-768x1152.jpg", 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', "Infusion", ['Spiruline']],
        ['Smoothie Kale', "https://static.wixstatic.com/media/d0e351_e94466011ee4498f85d746b05f4b89b4~mv2.jpg/v1/fill/w_1110,h_1671,al_c,q_90/d0e351_e94466011ee4498f85d746b05f4b89b4~mv2.webp", 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', "Café", ['Kale']],
        ['Chocolat au xocoati', "https://cdn.shopify.com/s/files/1/0071/0544/5955/files/Matcha_Coffee_1024x1024.jpg?v=1601756452", 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', "Latte", ['Xocoati']],
        ['Iced Coffee', "https://893364.smushcdn.com/2102600/wp-content/uploads/2020/03/Smoothie-3495.jpg?lossy=1&strip=1&webp=1", 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', "Chocolat", ['Café']],
        ['Infusion au gingembre', "https://init4thelongrun.com/wp-content/uploads/2018/10/Magic_Chocolate_Elixir-8-of-26-768x1152.jpg", 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', "Thé", ['Gingembre']],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::DRINK as $drinkName) {
            $drink = new Drink();
            $drink->setName($drinkName[0]);
            $this->addReference($drinkName[0], $drink);
            $drink->setImage($drinkName[1]);
            $drink->setDescription($drinkName[2]);
            $drink->setCategoryDrink($this->getReference($drinkName[3]));
            foreach ($drinkName[4] as $ingredient) {
                $drink->addIngredient($this->getReference($ingredient));
            }
            $manager->persist($drink);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            IngredientFixtures::class,
            CategoryDrinkFixtures::class,
            BenefitFixtures::class,
        ];
    }
}

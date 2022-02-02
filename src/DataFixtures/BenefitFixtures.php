<?php

namespace App\DataFixtures;

use App\Entity\Benefit;
use App\DataFixtures\DrinkFixtures;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\IngredientFixtures;
use App\DataFixtures\CategoryDrinkFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BenefitFixtures extends Fixture implements DependentFixtureInterface
{
    public const BENEFIT = [
        'Tonicité',
        'Relaxant',
        'Energie',
        'Détox',
        'Fortifiant',
        'Minceur',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::BENEFIT as $benefitName) {
            $benefit = new Benefit();
            $benefit->setName($benefitName[0]);
            $this->addReference($benefitName[0], $benefit);
            $manager->persist($benefit);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            IngredientFixtures::class,
            DrinkFixtures::class,
            CategoryDrinkFixtures::class,
        ];
    }
}

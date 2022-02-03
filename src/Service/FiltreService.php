<?php

namespace App\Service;

use App\Entity\Ingredient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FiltreService extends AbstractController
{
    public function filtreBenefit(Ingredient $ingredient)
    {
        $benefits = [];

        foreach ($ingredient->getBenefits() as $b) {
            $benefits[] = $b->getName();
        }

        return $benefits;
    }


    public function filtreDrink(Ingredient $ingredient)
    {
        $drinks = [];

        foreach ($ingredient->getDrinks() as $d) {
            $drinks[] = $d->getName();
        }
    }
}

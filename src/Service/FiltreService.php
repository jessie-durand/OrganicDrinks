<?php

namespace App\Service;

use App\Entity\Ingredient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FiltreService extends AbstractController
{
    public function filtreBenefit(Ingredient $ingredient)
    {

        return $ingredient->getBenefits();
    }


    public function filtreDrink(Ingredient $ingredient)
    {
        return $ingredient->getDrinks();
    }
}

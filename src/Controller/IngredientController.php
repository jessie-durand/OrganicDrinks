<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Service\FiltreService;
use App\Form\SearchIngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IngredientController extends AbstractController
{
    #[Route('/ingredient', name: 'ingredient_index', methods: ['GET', 'POST'])]
    public function index(Request $request, IngredientRepository $ingredientRepository): Response
    {
        $form = $this->createForm(SearchIngredientType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $ingredients = $ingredientRepository->findBy(['name' => $search]);
        } else {
            $ingredients = $ingredientRepository->findAll();
        }

        return $this->render('user/ingredient/index.html.twig', [
            'ingredients' => $ingredients,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/ingredient', name: 'ingredient_index_admin', methods: ['GET', 'POST'])]
    public function indexAdmin(Request $request, IngredientRepository $ingredientRepository): Response
    {
        $form = $this->createForm(SearchIngredientType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $ingredients = $ingredientRepository->findBy(['name' => $search]);
        } else {
            $ingredients = $ingredientRepository->findAll();
        }

        return $this->render('admin/ingredient/index.html.twig', [
            'ingredients' => $ingredients,
            'form' => $form->createView(),
        ]);
    }

    #[Route('admin/ingredient/new', name: 'ingredient_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ingredient);
            $entityManager->flush();

            return $this->redirectToRoute('ingredient_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/ingredient/new.html.twig', [
            'ingredient' => $ingredient,
            'form' => $form,
        ]);
    }

    #[Route('ingredient/{id}', name: 'ingredient_show', methods: ['GET'])]
    public function show(Ingredient $ingredient): Response
    {
        return $this->render('user/ingredient/show.html.twig', [
            'ingredient' => $ingredient,
        ]);
    }

    #[Route('admin/ingredient/{id}/edit', name: 'ingredient_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ingredient $ingredient, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('ingredient_index_admin', [], Response::HTTP_SEE_OTHER);
        }



        return $this->renderForm('admin/ingredient/edit.html.twig', [
            'ingredient' => $ingredient,
            'form' => $form,
        ]);
    }

    #[Route('admin/ingredient/{id}', name: 'ingredient_delete', methods: ['POST'])]
    public function delete(Request $request, Ingredient $ingredient, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $ingredient->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ingredient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ingredient_index', [], Response::HTTP_SEE_OTHER);
    }
}

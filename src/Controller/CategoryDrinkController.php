<?php

namespace App\Controller;

use App\Entity\CategoryDrink;
use App\Form\CategoryDrinkType;
use App\Repository\CategoryDrinkRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category/drink')]
class CategoryDrinkController extends AbstractController
{
    #[Route('/', name: 'category_drink_index', methods: ['GET'])]
    public function index(CategoryDrinkRepository $categoryDrinkRepository): Response
    {
        return $this->render('category_drink/index.html.twig', [
            'category_drinks' => $categoryDrinkRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'category_drink_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categoryDrink = new CategoryDrink();
        $form = $this->createForm(CategoryDrinkType::class, $categoryDrink);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categoryDrink);
            $entityManager->flush();

            return $this->redirectToRoute('category_drink_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('category_drink/new.html.twig', [
            'category_drink' => $categoryDrink,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'category_drink_show', methods: ['GET'])]
    public function show(CategoryDrink $categoryDrink): Response
    {
        return $this->render('category_drink/show.html.twig', [
            'category_drink' => $categoryDrink,
        ]);
    }

    #[Route('/{id}/edit', name: 'category_drink_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategoryDrink $categoryDrink, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoryDrinkType::class, $categoryDrink);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('category_drink_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('category_drink/edit.html.twig', [
            'category_drink' => $categoryDrink,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'category_drink_delete', methods: ['POST'])]
    public function delete(Request $request, CategoryDrink $categoryDrink, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoryDrink->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categoryDrink);
            $entityManager->flush();
        }

        return $this->redirectToRoute('category_drink_index', [], Response::HTTP_SEE_OTHER);
    }
}

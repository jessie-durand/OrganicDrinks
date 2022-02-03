<?php

namespace App\Controller;

use App\Entity\Drink;
use App\Form\DrinkType;
use App\Form\SearchDrinkType;
use App\Repository\DrinkRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/drink')]
class DrinkController extends AbstractController
{
    #[Route('/', name: 'drink_index', methods: ['GET', 'POST'])]
    public function index(Request $request, DrinkRepository $drinkRepository): Response
    {
        $form = $this->createForm(SearchDrinkType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $drinks = $drinkRepository->findBy(['name' => $search]);
        } else {
            $drinks = $drinkRepository->findAll();
        }

        return $this->render('drink/index.html.twig', [
            'drinks' => $drinks,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/new', name: 'drink_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $drink = new Drink();
        $form = $this->createForm(DrinkType::class, $drink);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($drink);
            $entityManager->flush();

            return $this->redirectToRoute('drink_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('drink/new.html.twig', [
            'drink' => $drink,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'drink_show', methods: ['GET'])]
    public function show(Drink $drink): Response
    {
        return $this->render('drink/show.html.twig', [
            'drink' => $drink,
        ]);
    }

    #[Route('/{id}/edit', name: 'drink_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Drink $drink, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DrinkType::class, $drink);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('drink_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('drink/edit.html.twig', [
            'drink' => $drink,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'drink_delete', methods: ['POST'])]
    public function delete(Request $request, Drink $drink, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $drink->getId(), $request->request->get('_token'))) {
            $entityManager->remove($drink);
            $entityManager->flush();
        }

        return $this->redirectToRoute('drink_index', [], Response::HTTP_SEE_OTHER);
    }
}

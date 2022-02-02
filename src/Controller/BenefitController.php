<?php

namespace App\Controller;

use App\Entity\Benefit;
use App\Form\BenefitType;
use App\Repository\BenefitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/benefit')]
class BenefitController extends AbstractController
{
    #[Route('/', name: 'benefit_index', methods: ['GET'])]
    public function index(BenefitRepository $benefitRepository): Response
    {
        return $this->render('benefit/index.html.twig', [
            'benefits' => $benefitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'benefit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $benefit = new Benefit();
        $form = $this->createForm(BenefitType::class, $benefit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($benefit);
            $entityManager->flush();

            return $this->redirectToRoute('benefit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('benefit/new.html.twig', [
            'benefit' => $benefit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'benefit_show', methods: ['GET'])]
    public function show(Benefit $benefit): Response
    {
        return $this->render('benefit/show.html.twig', [
            'benefit' => $benefit,
        ]);
    }

    #[Route('/{id}/edit', name: 'benefit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Benefit $benefit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BenefitType::class, $benefit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('benefit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('benefit/edit.html.twig', [
            'benefit' => $benefit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'benefit_delete', methods: ['POST'])]
    public function delete(Request $request, Benefit $benefit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$benefit->getId(), $request->request->get('_token'))) {
            $entityManager->remove($benefit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('benefit_index', [], Response::HTTP_SEE_OTHER);
    }
}

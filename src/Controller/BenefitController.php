<?php

namespace App\Controller;

use App\Entity\Benefit;
use App\Form\BenefitType;
use App\Form\SearchBenefitType;
use App\Repository\BenefitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class BenefitController extends AbstractController
{
    #[Route('/benefit', name: 'benefit_index', methods: ['GET', 'POST'])]
    public function index(Request $request, BenefitRepository $benefitRepository): Response
    {
        $form = $this->createForm(SearchBenefitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $benefits = $benefitRepository->findBy(['name' => $search]);
        } else {
            $benefits = $benefitRepository->findAll();
        }

        return $this->render('user/benefit/index.html.twig', [
            'benefits' => $benefits,
            'form' => $form->createView(),
        ]);
    }

    #[Route('admin/benefit', name: 'benefit_index_admin', methods: ['GET', 'POST'])]
    public function indexAdmin(Request $request, BenefitRepository $benefitRepository): Response
    {
        $form = $this->createForm(SearchBenefitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $benefits = $benefitRepository->findBy(['name' => $search]);
        } else {
            $benefits = $benefitRepository->findAll();
        }

        return $this->render('admin/benefit/index.html.twig', [
            'benefits' => $benefits,
            'form' => $form->createView(),
        ]);
    }

    #[Route('admin/benefit/new', name: 'benefit_new', methods: ['GET', 'POST'])]
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

        return $this->renderForm('admin/benefit/new.html.twig', [
            'benefit' => $benefit,
            'form' => $form,
        ]);
    }

    #[Route('benefit/{id}', name: 'benefit_show', methods: ['GET'])]
    public function show(Benefit $benefit): Response
    {
        return $this->render('user/benefit/show.html.twig', [
            'benefit' => $benefit,
        ]);
    }

    #[Route('admin/benefit/{id}/edit', name: 'benefit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Benefit $benefit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BenefitType::class, $benefit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('benefit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/benefit/edit.html.twig', [
            'benefit' => $benefit,
            'form' => $form,
        ]);
    }

    #[Route('admin/benefit/{id}', name: 'benefit_delete', methods: ['POST'])]
    public function delete(Request $request, Benefit $benefit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $benefit->getId(), $request->request->get('_token'))) {
            $entityManager->remove($benefit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('benefit_index', [], Response::HTTP_SEE_OTHER);
    }
}

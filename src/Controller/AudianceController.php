<?php
// src/Controller/AudianceController.php

namespace App\Controller;

use App\Entity\Audiance;
use App\Form\AudianceType;
use App\Repository\AudienceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/court-infos')]
class AudianceController extends AbstractController
{
    #[Route('/', name: 'app_court_info_index', methods: ['GET'])]
    public function index(AudienceRepository $AudienceRepositoryNew): Response
    {
        return $this->render('audiance/index.html.twig', [
            'audiances' => $AudienceRepositoryNew->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_court_info_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $audiance = new Audiance();
        $form = $this->createForm(AudianceType::class, $audiance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($audiance);
            $entityManager->flush();

            return $this->redirectToRoute('app_court_info_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('audiance/new.html.twig', [
            'audiance' => $audiance,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_court_info_show', methods: ['GET'])]
    public function show(Audiance $audiance): Response
    {
        return $this->render('audiance/show.html.twig', [
            'audiance' => $audiance,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_court_info_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Audiance $audiance, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AudianceType::class, $audiance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_court_info_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('audiance/edit.html.twig', [
            'audiance' => $audiance,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_court_info_delete', methods: ['POST'])]
    public function delete(Request $request, Audiance $audiance, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $audiance->getId(), $request->request->get('_token'))) {
            $entityManager->remove($audiance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_court_info_index', [], Response::HTTP_SEE_OTHER);
    }
}

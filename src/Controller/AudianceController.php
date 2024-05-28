<?php

namespace App\Controller;

use App\Entity\Audiance;
use App\Form\Audiance1Type;
use App\Repository\AudienceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/court-infos')]
class AudianceController extends AbstractController
{
    #[Route('/', name: 'app_audiance_index', methods: ['GET'])]
    public function index(AudienceRepository $audienceRepository): Response
    {
        return $this->render('audiance/index.html.twig', [
            'audiances' => $audienceRepository->findAll(),
        ]);
    }
    
    #[Route('/2', name: 'app_audiance_index2', methods: ['GET'])]
    public function index2(AudienceRepository $audienceRepository): Response
    {
        return $this->render('audiance/index2.html.twig', [
            'audiances' => $audienceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_audiance_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $audiance = new Audiance();
        $form = $this->createForm(Audiance1Type::class, $audiance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($audiance);
            $entityManager->flush();

            return $this->redirectToRoute('app_audiance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('audiance/new.html.twig', [
            'audiance' => $audiance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_audiance_show', methods: ['GET'])]
    public function show(Audiance $audiance): Response
    {
        return $this->render('audiance/show.html.twig', [
            'audiance' => $audiance,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_audiance_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Audiance $audiance, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Audiance1Type::class, $audiance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_audiance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('audiance/edit.html.twig', [
            'audiance' => $audiance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_audiance_delete', methods: ['POST'])]
    public function delete(Request $request, Audiance $audiance, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$audiance->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($audiance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_audiance_index', [], Response::HTTP_SEE_OTHER);
    }
}

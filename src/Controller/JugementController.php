<?php

namespace App\Controller;

use App\Entity\Jugement;
use App\Form\JugementType;
use App\Repository\JugementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/jugement')]
class JugementController extends AbstractController
{
    #[Route('/', name: 'app_jugement_index', methods: ['GET'])]
    public function index(JugementRepository $jugementRepository): Response
    {
        return $this->render('jugement/index.html.twig', [
            'jugements' => $jugementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_jugement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $jugement = new Jugement();
        $form = $this->createForm(JugementType::class, $jugement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($jugement);
            $entityManager->flush();

            return $this->redirectToRoute('app_jugement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('jugement/new.html.twig', [
            'jugement' => $jugement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_jugement_show', methods: ['GET'])]
    public function show(Jugement $jugement): Response
    {
        return $this->render('jugement/show.html.twig', [
            'jugement' => $jugement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_jugement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Jugement $jugement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(JugementType::class, $jugement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_jugement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('jugement/edit.html.twig', [
            'jugement' => $jugement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_jugement_delete', methods: ['POST'])]
    public function delete(Request $request, Jugement $jugement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jugement->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($jugement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_jugement_index', [], Response::HTTP_SEE_OTHER);
    }
}

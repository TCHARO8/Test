<?php

namespace App\Controller;

use App\Entity\Source;
use App\Form\SourceType;
use App\Repository\SourceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/service')]
class SourceController extends AbstractController
{
    #[Route('/', name: 'app_service_index')]
    public function index(SourceRepository $sourceRepository): Response
    {
        return $this->render('source/index.html.twig', [
            'sources' => $sourceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_service_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SourceRepository $sourceRepository): Response
    {
        $source = new Source();
        $form = $this->createForm(SourceType::class, $source);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sourceRepository->save($source,true);

            $this->addFlash('success', 'Enregistrement effectué avec succès');

            return $this->redirectToRoute('app_service_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('source/new.html.twig', [
            'source' => $source,
            'sources' => $sourceRepository->findAll(),
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_source_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Source $source, SourceRepository $sourceRepository): Response
    {
        $form = $this->createForm(SourceType::class, $source);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sourceRepository->save($source, true);

            $this->addFlash('success', 'Modification effectuée avec succès');

            return $this->redirectToRoute('app_service_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('source/new.html.twig', [
            'source' => $source,
            'sources' => $sourceRepository->findAll(),
            'form' => $form,
        ]);
    }

//    #[Route('/{id}', name: 'app_service_show', methods: ['GET'])]
//    public function show(Source $source): Response
//    {
//        return $this->render('source/show.html.twig', [
//            'source' => $source,
//        ]);
//    }

    #[Route('/{id}', name: 'app_service_delete', methods: ['POST'])]
    public function delete(Request $request, Source $source, SourceRepository $sourceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$source->getId(), $request->request->get('_token'))) {
            $sourceRepository->remove($source, true);
        }

        return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
    }

}

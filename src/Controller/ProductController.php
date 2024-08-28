<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/')]
class ProductController extends AbstractController
{
    private EntityManagerInterface $manager;

    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository, EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        $this->productRepository = $productRepository;

    }

    #[Route('/product', name: 'app_produit_index')]
    public function index(ProductRepository $productRepository): Response
    {
        $produit = $this->productRepository->findBy(['deleted' => false]);
        return $this->render('product/index.html.twig', [
            'produits' => $produit,
        ]);
    }

    #[Route('/product/new', name: 'app_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProductRepository $productRepository): Response
    {
        $produit = new Product();
        $form = $this->createForm(ProductType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produit->setDeleted(false);
            $productRepository->save($produit,true);

            $this->addFlash('success', 'Enregistrement effectué avec succès');

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product/new.html.twig', [
            'produit' => $produit,
            'produits' => $productRepository->findAll(),
            'form' => $form,
        ]);
    }


    #[Route('/product/edit/{id}', name: 'app_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product, ProductRepository $productRepository): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productRepository->save($product, true);

            $this->addFlash('success', 'Modification effectuée avec succès');

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product/edit.html.twig', [
            'produit' => $product,
            'produits' => $productRepository->findAll(),
            'form' => $form,
        ]);
    }

    #[Route('/product/delete/{id}', name: 'app_suprimer_produit', methods: ['GET', 'POST'])]
    public function supprimerProduit(Product $product): Response
    {
        $product -> setDeleted(true);
        $this->manager->persist($product);
        $this->manager->flush();

        $this->addFlash('success', "Un produit vient d'être supprimé");
        return $this->redirectToRoute("app_produit_index");
    }

}


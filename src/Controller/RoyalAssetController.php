<?php

namespace App\Controller;

use App\Entity\RoyalAsset;
use App\Form\RoyalAssetType;
use App\Repository\RoyalAssetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/royal-asset")
 */
class RoyalAssetController extends AbstractController
{
    /**
     * @Route("/", name="royal_asset_index", methods={"GET"})
     */
    public function index(RoyalAssetRepository $royalAssetRepository): Response
    {   
        return $this->render('royal_asset/index.html.twig', [
            'royal_assets' => $royalAssetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="royal_asset_new", methods={"GET","POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $royalAsset = new RoyalAsset();
        $form = $this->createForm(RoyalAssetType::class, $royalAsset);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $royalAsset->setUser($this->getUser());
            $entityManager->persist($royalAsset);
            $entityManager->flush();

            return $this->redirectToRoute('royal_asset_index');
        }

        return $this->render('royal_asset/new.html.twig', [
            'royal_asset' => $royalAsset,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="royal_asset_show", methods={"GET"})
     */
    public function show(RoyalAsset $royalAsset): Response
    {
        return $this->render('royal_asset/show.html.twig', [
            'royal_asset' => $royalAsset,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="royal_asset_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RoyalAsset $royalAsset, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RoyalAssetType::class, $royalAsset);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $royalAsset->setUser($this->getUser());
            $entityManager->flush();

            return $this->redirectToRoute('royal_asset_index');
        }

        return $this->render('royal_asset/edit.html.twig', [
            'royal_asset' => $royalAsset,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="royal_asset_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RoyalAsset $royalAsset, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$royalAsset->getId(), $request->request->get('_token'))) {
            $entityManager->remove($royalAsset);
            $entityManager->flush();
        }

        return $this->redirectToRoute('royal_asset_index');
    }
}

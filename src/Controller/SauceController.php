<?php

namespace App\Controller;

use App\Entity\Sauce;
use App\Form\SauceType;
use App\Repository\SauceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sauce")
 */
class SauceController extends AbstractController
{
    /**
     * @Route("/", name="sauce_index", methods={"GET"})
     * @param SauceRepository $sauceRepository
     * @return Response
     */
    public function index(SauceRepository $sauceRepository): Response
    {
        return $this->render('sauce/index.html.twig', [
            'sauces' => $sauceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sauce_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sauce = new Sauce();
        $form = $this->createForm(SauceType::class, $sauce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sauce);
            $entityManager->flush();

            return $this->redirectToRoute('sauce_index');
        }

        return $this->render('sauce/new.html.twig', [
            'sauce' => $sauce,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sauce_show", methods={"GET"})
     */
    public function show(Sauce $sauce): Response
    {
        return $this->render('sauce/show.html.twig', [
            'sauce' => $sauce,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sauce_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sauce $sauce): Response
    {
        $form = $this->createForm(SauceType::class, $sauce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sauce_index');
        }

        return $this->render('sauce/edit.html.twig', [
            'sauce' => $sauce,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sauce_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sauce $sauce): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sauce->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sauce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sauce_index');
    }
}

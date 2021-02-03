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
     * @Route("/", name="sauces", methods={"GET"})
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
     * @Route("/{id}", name="sauce_show", methods={"GET"})
     * @param Sauce $sauce
     * @return Response
     */
    public function show(Sauce $sauce): Response
    {
        return $this->render('sauce/show.html.twig', [
            'sauce' => $sauce,
        ]);
    }
}

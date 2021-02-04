<?php

namespace App\Controller;

use App\Entity\Sauce;
use App\Form\SauceType;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
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
     * @Route("/{id}", name="sauce_show", methods={"GET","POST"})
     * @param Sauce $sauce
     * @param Request $request
     * @return Response
     */
    public function showSauces(Sauce $sauce, Request $request): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $comment->setSauce($sauce);
            $comment->setUser($this->getUser());
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('sauces');
        }

        return $this->render('sauce/show.html.twig', [
            'sauce' => $sauce,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="sauce_comment_delete", methods={"DELETE"})
     * @param Request $request
     * @param Comment $comment
     * @return Response
     */
    public function delete(Request $request, Comment $comment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sauces');
    }
}

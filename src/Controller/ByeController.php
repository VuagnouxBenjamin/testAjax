<?php

namespace App\Controller;

use App\Entity\Bye;
use App\Form\ByeType;
use App\Repository\ByeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bye")
 */
class ByeController extends AbstractController
{
    /**
     * @Route("/", name="bye_index", methods={"GET"})
     */
    public function index(ByeRepository $byeRepository): Response
    {
        return $this->render('bye/index.html.twig', [
            'byes' => $byeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bye_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bye = new Bye();
        $form = $this->createForm(ByeType::class, $bye);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bye);
            $entityManager->flush();

            return $this->redirectToRoute('bye_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bye/new.html.twig', [
            'bye' => $bye,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bye_show", methods={"GET"})
     */
    public function show(Bye $bye): Response
    {
        return $this->render('bye/show.html.twig', [
            'bye' => $bye,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bye_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bye $bye): Response
    {
        $form = $this->createForm(ByeType::class, $bye);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bye_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bye/edit.html.twig', [
            'bye' => $bye,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bye_delete", methods={"POST"})
     */
    public function delete(Request $request, Bye $bye): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bye->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bye);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bye_index', [], Response::HTTP_SEE_OTHER);
    }
}

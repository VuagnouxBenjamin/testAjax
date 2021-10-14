<?php

namespace App\Controller;

use App\Entity\Hello;
use App\Form\HelloType;
use App\Repository\HelloRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hello")
 */
class HelloController extends AbstractController
{
    /**
     * @Route("/", name="hello_index", methods={"GET"})
     */
    public function index(HelloRepository $helloRepository): Response
    {
        return $this->render('hello/index.html.twig', [
            'hellos' => $helloRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="hello_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $hello = new Hello();
        $form = $this->createForm(HelloType::class, $hello);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hello);
            $entityManager->flush();

            return $this->redirectToRoute('hello_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hello/new.html.twig', [
            'hello' => $hello,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="hello_show", methods={"GET"})
     */
    public function show(Hello $hello): Response
    {
        return $this->render('hello/show.html.twig', [
            'hello' => $hello,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="hello_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Hello $hello): Response
    {
        $form = $this->createForm(HelloType::class, $hello);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hello_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hello/edit.html.twig', [
            'hello' => $hello,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="hello_delete", methods={"POST"})
     */
    public function delete(Request $request, Hello $hello): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hello->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($hello);
            $entityManager->flush();
        }

        return $this->redirectToRoute('hello_index', [], Response::HTTP_SEE_OTHER);
    }
}

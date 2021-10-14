<?php

namespace App\Controller;

use App\Entity\Hello;
use App\Entity\HelloLike;
use App\Repository\HelloLikeRepository;
use App\Repository\HelloRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(HelloRepository $helloRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'hellos' => $helloRepository->findAll(),
        ]);
    }

    /**
     * Permet de liker ou unliker un article
     *
     * @Route("/hello/{id}/like", name="hello_like")
     *
     * @param Hello $hello
     * @param ObjectManager $manager
     * @param HelloLikeRepository $likeRepo
     * @return Response
     */
    public function like(Hello $hello, EntityManagerInterface $manager, HelloLikeRepository $likeRepo): Response
    {
        $user = $this->getUser();
        // 3 cas de figures
        // 1 - le gars n'est aps connecté : code 403
        if (!$user) return $this->json([
            'code' => 403,
            'message' => 'unothorized user',
        ], 403);

        // 2 - le gars aime deja il faut supp le like
        if ($hello->isLikedByUser($user)) {
            $like = $likeRepo->findOneBy([
                'user' => $user,
                'hello' => $hello
            ]);

            $manager->remove($like);
            $manager->flush();

            return $this->json([
                'code' => 200,
                'message' => 'like bien retiré',
                'likes' => $likeRepo->count(['hello' => $hello]),
            ], 200);
        }

        // 2 - le gars aime pas, il faut add le like

        $like = new HelloLike();
        $like
            ->setHello($hello)
            ->setUser($user);

        $manager->persist($like);
        $manager->flush();

        return $this->json([
            'code' => 200,
            "message" => "ca marche bien",
            'likes' => $likeRepo->count(['hello' => $hello]),
        ], 200);
    }
}

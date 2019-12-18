<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/home", name="default", name="home")
     */
    public function index(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = $this->getDoctrine()->getRepository(User::class)->find(1);

        $video = $this->getDoctrine()->getRepository(Video::class)->find(1);

        $user->removeVideo($video);
        $entityManager->flush();

        foreach ($user->getVideos() as $video) {
            dump($video->getTitle());
        }

        // $entityManager->remove($user);
        // $entityManager->flush();

        // dump($user);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'Le Contrôleur'
        ]);
    }
}
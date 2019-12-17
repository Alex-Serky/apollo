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

        // $user = new User();
        // $user->setName('Alex');

        // for ($i = 1; $i <= 3; $i++) {
        //     $video = new Video();
        //     $video->setTitle('Titre de la Vidéo - ' . $i);
        //     $user->addVideo($video);
        //     $entityManager->persist($video);
        // }

        // $entityManager->persist($user);
        // $entityManager->flush();

        // dump('Créez une vidéo avec l\'id de ' . $video->getId());
        // dump('Créez un utilisateur avec l\'id de ' . $user->getId());

        // // Ou bien
        // $video = $this->getDoctrine()->getRepository(Video::class)->find(1);

        // // dump($video->getUser());
        // dump($video->getUser()->getName());

        // Ou bien
        $user = $this->getDoctrine()->getRepository(User::class)->find(1);

        foreach ($user->getVideos() as $video) {
            dump($video->getTitle());
        }

        return $this->render('default/index.html.twig', [
            'controller_name' => 'Le Contrôleur'
        ]);
    }
}
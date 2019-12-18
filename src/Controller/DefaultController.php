<?php

namespace App\Controller;

use App\Entity\Address;
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
        //     $video->setTitle('Titre de la vidéo - ' . $i);
        //     $user->addVideo($video);
        //     $entityManager->persist($video);
        // }

        // $entityManager->persist($user);
        // $entityManager->flush();

        $user = $entityManager->getRepository(User::class)->find(1);
        dump($user);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'Le Contrôleur'
        ]);
    }
}
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

        // for ($i = 1; $i <= 4; $i++) {
        //     $user = new User();
        //     $user->setName('Alex -' . $i);
        //     $entityManager->persist($user);
        // }

        // $entityManager->flush();

        // dump('Dernier identifiant utilisateur - ' . $user->getId());

        // Ou bien
        $user1 = $entityManager->getRepository(User::class)->find(1);
        $user2 = $entityManager->getRepository(User::class)->find(2);
        $user3 = $entityManager->getRepository(User::class)->find(3);
        $user4 = $entityManager->getRepository(User::class)->find(4);

        // $user1->addFollowed($user2);
        // $user1->addFollowed($user3);
        // $user1->addFollowed($user4);

        // $entityManager->flush();

        dump($user1->getFollowed()->count());
        dump($user1->getFollowing()->count());
        dump($user3->getFollowing()->count());

        return $this->render('default/index.html.twig', [
            'controller_name' => 'Le Contrôleur'
        ]);
    }
}
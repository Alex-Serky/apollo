<?php

namespace App\Controller;

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

        $conn = $entityManager->getConnection();
        $sql = '
        SELECT * FROM user u
        WHERE u.id > :id
        ';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => 3]);

        $entityManager->flush();

        dump($stmt->fetchAll());

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }
}
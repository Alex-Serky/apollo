<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\GiftsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends AbstractController
{
    /**
     * @Route("/home", name="default", name="home")
     */
    public function index(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $id = 2;

        $user = $entityManager->getRepository(User::class)->find($id);

        $entityManager->remove($user);
        $entityManager->flush();

        dump($user);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }
}
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
        $repository = $this->getDoctrine()->getRepository(User::class);

        // $users = $repository->find(1);
        // $users = $repository->findOneBy(['name' => 'Alex']);
        // $users = $repository->findOneBy([
        //     'name' => 'Alex',
        //     'id' => 5
        // ]);
        // $users = $repository->findOneBy(
        //     [
        //         'name' => 'Alex'
        //     ],
        //     [
        //         'id' => 'DESC'
        //     ]
        // );
        $users = $repository->findAll();
        dump($users);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }
}
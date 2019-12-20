<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\User;
use App\Entity\Video;
use App\Entity\File;
use App\Entity\Pdf;
use App\Entity\Author;
use App\Services\GiftsService;
use App\Services\MyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\ServiceInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\TagAwareAdapter;

class DefaultController extends AbstractController
{
    /**
     * @Route("/home", name="default", name="home")
     */
    public function index(Request $request)
    {
        // $entityManager = $this->getDoctrine()->getManager();

        dump($request, $this);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'Le Contrôleur'
        ]);
    }
}
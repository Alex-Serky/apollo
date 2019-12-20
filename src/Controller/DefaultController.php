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

class DefaultController extends AbstractController
{
    /**
     * @Route("/home", name="default", name="home")
     */
    public function index(Request $request, ServiceInterface $service)
    {
        // $entityManager = $this->getDoctrine()->getManager();

        $cache = new FilesystemAdapter();
        $posts = $cache->getItem('database.get_posts');

        if (!$posts->isHit()) {
            $posts_from_db = ['post 1', 'post 2', 'post 3'];
            dump('Connecté avec la base de données ...');

            $posts->set(serialize($posts_from_db));
            $posts->expiresAfter(5);
            $cache->save($posts);
        }
        // $cache->deleteItem('database.get_posts');
        $cache->clear();
        dump(unserialize($posts->get()));


        return $this->render('default/index.html.twig', [
            'controller_name' => 'Le Contrôleur'
        ]);
    }
}
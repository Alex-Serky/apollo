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

        $cache = new TagAwareAdapter(
            new FilesystemAdapter()
        );

        $acer = $cache->getItem('acer');
        $asus = $cache->getItem('asus');
        $dell = $cache->getItem('dell');
        $ibm = $cache->getItem('ibm');
        $apple = $cache->getItem('apple');

        if (!$asus->isHit()) {
            $asus_from_db = 'asus laptop';
            $asus->set($asus_from_db);
            $asus->tag(['computers', 'laptops', 'asus']);
            $cache->save($asus);
            dump('asus laptop from database ...');
        }

        if (!$ibm->isHit()) {
            $ibm_from_db = 'ibm desktop';
            $ibm->set($ibm_from_db);
            $ibm->tag(['computers', 'desktops', 'ibm']);
            $cache->save($ibm);
            dump('ibm desktop from database ...');
        }

        if (!$dell->isHit()) {
            $dell_from_db = 'dell laptop';
            $dell->set($dell_from_db);
            $dell->tag(['computers', 'laptops', 'dell']);
            $cache->save($dell);
            dump('dell laptop from database ...');
        }

        if (!$acer->isHit()) {
            $acer_from_db = 'acer desktop';
            $acer->set($acer_from_db);
            $acer->tag(['computers', 'desktops', 'acer']);
            $cache->save($acer);
            dump('acer desktop from database ...');
        }

        if (!$apple->isHit()) {
            $apple_from_db = 'apple desktop';
            $apple->set($apple_from_db);
            $apple->tag(['computers', 'desktops', 'apple']);
            $cache->save($apple);
            dump('apple desktop from database ...');
        }

        $cache->invalidateTags(['ibm']);
        $cache->invalidateTags(['desktops']);
        $cache->invalidateTags(['computers']);
        $cache->invalidateTags(['laptops']);

        dump($acer->get());
        dump($dell->get());
        dump($ibm->get());
        dump($apple->get());


        return $this->render('default/index.html.twig', [
            'controller_name' => 'Le Contrôleur'
        ]);
    }
}
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
use App\Events\VideoCreatedEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\ServiceInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\TagAwareAdapter;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class DefaultController extends AbstractController
{
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @Route("/home", name="default", name="home")
     */
    public function index(Request $request)
    {
        // $entityManager = $this->getDoctrine()->getManager();

        $video = new \stdClass();
        $video->title = 'Funny movie';
        $video->category = 'funny';

        $event = new VideoCreatedEvent($video);
        $this->dispatcher->dispatch('video.created.event', $event);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'Le Contrôleur'
        ]);
    }
}
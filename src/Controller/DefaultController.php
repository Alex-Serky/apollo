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
use App\Form\VideoFormType;

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
        $entityManager = $this->getDoctrine()->getManager();
        // $videos = $entityManager->getRepository(Video::class)->findAll();
        // dump($videos);

        // $video = new Video();
        // $video->setTitle('Rédiger un article de blog');
        // $video->setCreatedAt(new \DateTime('tomorrow'));

        $video = $entityManager->getRepository(Video::class)->find(1);

        $form = $this->createForm(VideoFormType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('file')->getData();
            $fileName = sha1(random_bytes(14)) . '.' . $file->guessExtension();
            $file->move(
                $this->getParameter('videos_directory'),
                $fileName
            );
            $video->setFile($fileName);
            $entityManager->persist($video);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render(
            'default/index.html.twig',
            [
                'controller_name' => 'Le Contrôleur',
                'form' => $form->createView(),
            ]
        );
    }
}
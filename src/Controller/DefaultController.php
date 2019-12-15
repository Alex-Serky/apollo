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
    public function __construct($logger)
    {
        // use $logger service
    }

    /**
     * @Route("/", name="default")
     */
    public function index(GiftsService $gifts, Request $request)
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        // if (!$users) {
        //     throw $this->createNotFoundException('Les utilisateurs n\'existent pas');
        // }


        $cookie = new Cookie(
            'my_cookie', // Cookie name
            'cookie value', // Cookie value
            time() + (2 * 365 * 24 * 60 * 60) // Expires after 2 years
        );

        $res = new Response();
        $res->headers->setCookie($cookie);
        $res->send();

        $res = new Response();
        $res->headers->clearCookie('my_cookie');

        $this->addFlash(
            'notice',
            'Votre modification a été enregistrée!'
        );

        $this->addFlash(
            'warning',
            'Votre modification a été enregistrée avec succès!'
        );

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'random_gift' => $gifts->gifts,
        ]);
    }

    /**
     * @Route("/blog/{page?}", name="blog_list", requirements={"page"="\d+"})
     */
    public function index2()
    {
        return new Response('Paramètres facultatifs dans l\'URL et exigences pour les paramètres');
    }

    /**
     * @Route(
     *  "/articles/{_locale}/{year}/{slug}/{category}",
     *  defaults={"category": "computers"},
     *  requirements={
     *      "_locale": "en|fr",
     *      "category":"computers|rtv",
     *      "year": "\d+"
     *    }
     * )
     */
    public function index3()
    {
        return new Response('Un exemple avancé de route');
    }

    /**
     *  @Route({
     *      "nl": "/over-ons",
     *      "en": "/about-us"
     * }, name="about_us")
     */
    public function index4()
    {
        return new Response('Les routes traduites');
    }

    /**
     * @Route("/generate-url/{param?}", name="generate_url")
     */
    public function generate_url()
    {
        exit($this->generateUrl(
            'generate_url',
            array('param' => 10),
            UrlGeneratorInterface::ABSOLUTE_URL
        ));
    }

    /**
     * @Route("/download")
     */
    public function download()
    {
        $path = $this->getParameter('download_directory');
        return $this->file($path . 'file.pdf');
    }

    /**
     * @Route("/redirect-test")
     */
    public function redirectTest()
    {
        return $this->redirectToRoute('route_to_redirect', array('param' => 10));
    }

    /**
     * @Route("/url-to-redirect/{param?}", name="route_to_redirect")
     */
    public function methodToRedirect()
    {
        exit('Test de redirection');
    }

    /**
     * @Route("/forwarding-to-controller")
     */
    public function forwardingToController()
    {
        $response = $this->forward(
            'App\Controller\DefaultController::methodToForwardTo',
            array('param' => '1')
        );
        return $response;
    }

    /**
     * @Route("/url-to-forward-to/{param?}", name="route_to_forward_to")
     */
    public function methodToForwardTo($param)
    {
        exit('Transmission du contrôleur de test - ' . $param);
    }

    public function mostPopularPosts($number = 3)
    {
        // database call
        $posts = ['post 1', 'post 2', 'post 3', 'post 4'];
        return $this->render('default/most_popular_posts.html.twig', [
            'posts' => $posts
        ]);
    }
}
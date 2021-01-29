<?php

namespace App\Controller\AndriiFun;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route ("/")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'phpversion' => phpversion(),
        ]);
    }

    /**
     * @Route ("/show/{id}")
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        // after installing with composer require profiler
        // and composer require debug we can monitor dump in debug toolbar and can ran command
        // php bin/console server:dump and we will see dump in console
        dump($id, $this);
//        dd($id, $this); debug and die

        return $this->render('@andrii/show.html.twig', [
            'id' => $id,
        ]);
    }
}
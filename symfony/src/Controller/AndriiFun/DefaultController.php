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
        dump($id, $this);

        return $this->render('@andrii/show.html.twig', [
            'id' => $id,
        ]);
    }
}
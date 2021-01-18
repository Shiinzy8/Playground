<?php

namespace App\Controller\AndriiFun;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     * @Route ("/")
     * @return Response
     */
    public function index(): Response
    {
        return new Response("Hello world + php version:" . phpversion());
    }

    /**
     * @Route ("/show/{id}")
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        return new Response("Future page to show something with id: {$id}");
    }
}
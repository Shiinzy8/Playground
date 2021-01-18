<?php

namespace App\Controller\AndriiFun;

use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    public function index(): Response
    {
        return new Response("Hello wolrd");
    }
}
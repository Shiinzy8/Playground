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
    public function homepage(): Response
    {
        return $this->render('@andrii/question/homepage.html.twig', []);
    }

    /**
     * @Route("/questions/{slug}", name="app_question_show")
     * @param string $slug
     * @return Response
     */
    public function questions(string $slug): Response
    {
        // after installing with composer require profiler
        // and composer require debug we can monitor dump in debug toolbar and can ran command
        // php bin/console server:dump and we will see dump in console
        dump($slug, $this);
        // dd($id, $this); debug and die


        $answers = [
            'Make sure your cat is sitting perfectly still 🤣',
            'Honestly, I like furry shoes better than MY cat',
            'Maybe... try saying the spell backwards?',
        ];

        return $this->render('@andrii/question/show.html.twig', [
            'question' => ucwords(str_replace('-', ' ', $slug)),
            'answers' => $answers,
        ]);
    }
}
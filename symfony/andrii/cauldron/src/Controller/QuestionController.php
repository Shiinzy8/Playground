<?php


namespace Cauldron\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * Class QuestionController
 * @package Cauldron\Controller
 */
class QuestionController extends AbstractController
{
    /**
     * @Route ("/", name="homepage")
     * @param Environment $twigEnvironment
     * @return Response
     */
    public function homepage(Environment $twigEnvironment): Response
    {
        /* long version
        $html = $twigEnvironment->render('@andrii/question/homepage.html.twig');

        return new Response($html);
        */

        return $this->render('@andrii_cauldron/question/homepage.html.twig', []);
    }

    /**
     * @Route("/questions/{slug}", name="question_show")
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

        return $this->render(
            '@andrii_cauldron/question/show.html.twig',
            [
                'question' => ucwords(str_replace('-', ' ', $slug)),
                'answers' => $answers,
            ]
        );
    }
}
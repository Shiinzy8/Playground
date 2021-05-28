<?php

namespace Write_solid\Controller;

use Write_solid\Repository\BigFootSightingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MainController
 * @package Write_solid\Controller
 */
class MainController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage(BigFootSightingRepository $bigFootSightingRepository): Response
    {
        $sightings = $bigFootSightingRepository->findLatest(25);

        return $this->render(
            '@andrii_write_solid/main/homepage.html.twig',
            [
                'sightings' => $sightings,
                'mostActiveSightings' => $sightings,
            ]
        );
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render('@andrii_write_solid/main/about.html.twig');
    }
}

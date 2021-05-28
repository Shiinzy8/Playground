<?php

namespace Write_solid\Controller;

use Write_solid\Entity\BigFootSighting;
use Write_solid\Form\BigfootSightingType;
use Write_solid\Service\SightingScorer;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BigFootSightingController
 * @package Write_solid\Controller
 */
class BigFootSightingController extends AbstractController
{
    /**
     * @Route("/sighting/upload", name="sighting_upload")
     * @IsGranted("ROLE_USER")
     */
    public function upload(Request $request, SightingScorer $sightingScorer, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(BigFootSightingType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var BigFootSighting $sighting */
            $sighting = $form->getData();
            $sighting->setOwner($this->getUser());

            $bfsScore = $sightingScorer->score($sighting);
            $sighting->setScore($bfsScore->getScore());

            $entityManager->persist($sighting);
            $entityManager->flush();

            $this->addFlash('success', 'New BigFoot Sighting created successfully!');

            return $this->redirectToRoute(
                'sighting_show',
                [
                    'id' => $sighting->getId()
                ]
            );
        }

        return $this->render(
            '@andrii_write_solid/main/sighting_new.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/sighting/{id}", name="sighting_show")
     */
    public function showSighting(BigFootSighting $bigFootSighting): Response
    {
        return $this->render(
            '@andrii_write_solid/main/sighting_show.html.twig',
            [
                'sighting' => $bigFootSighting,
            ]
        );
    }
}

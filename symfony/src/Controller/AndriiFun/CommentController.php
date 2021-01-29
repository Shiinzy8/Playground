<?php


namespace App\Controller\AndriiFun;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comment/{id}/vote/{direction}", name="")
     * @param int $id
     * @param string $direction
     * @return JsonResponse
     */
    public function commentVote(int $id, string $direction): JsonResponse
    {
        // TODO  use id to query database

        if ($direction == 'up') {
            $currentVotes = rand(7, 100);
        } else {
            $currentVotes = rand(0, 5);
        }

        return new JsonResponse(['votes' => $currentVotes,]);
//        return $this->json(['votes' => $currentVotes,]); // same as on top
//        return Response(json_encode(['votes' => $currentVotes,])); // same as on top
    }
}
<?php


namespace Cauldron\Controller;


use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CommentController
 * @package Cauldron\Controller
 */
class CommentController extends AbstractController
{
    /**
     * @Route("/comment/{id<\d+>}/vote/{direction<up|down>}", name="comment_vote", methods={"POST"})
     * @param int $id
     * @param string $direction
     * @param LoggerInterface $logger
     * @return JsonResponse
     */
    public function commentVote(int $id, string $direction, LoggerInterface $logger): JsonResponse
    {
        // TODO  use id to query database

        if ($direction == 'up') {
            $logger->info("Voting up!");
            $currentVotes = rand(7, 100);
        } else {
            $logger->info("Voting down!");
            $currentVotes = rand(0, 5);
        }

        return new JsonResponse(['votes' => $currentVotes,]);
//        return $this->json(['votes' => $currentVotes,]); // same as on top
//        return Response(json_encode(['votes' => $currentVotes,])); // same as on top
    }
}
<?php

namespace Write_solid\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Write_solid\Security\ConfitmationEmailsender;

class ResendConfirmationController extends AbstractController
{
    /**
     * @Route("/resend-confirmation", methods={"POST"})
     */
    public function resend(ConfitmationEmailsender $emailsender)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->getUser();

        $emailsender->send($user);

        return new Response(null, 204);
    }
}

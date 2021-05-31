<?php

namespace Write_solid\Security;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Write_solid\Entity\User;

class ConfitmationEmailsender
{
    private MailerInterface $mailer;
    private RouterInterface $router;

    public function __construct(MailerInterface $mailer, RouterInterface $router)
    {
        $this->mailer = $mailer;
        $this->router = $router;
    }

    public function send(User $user): void
    {
        $confirmationLink = $this->router->generate('andrii_write_solid_check_confirmation_link', [
            'token' => $user->getConfirmationToken(),
        ], UrlGeneratorInterface::ABSOLUTE_PATH);

        $confirmationEmail = (new TemplatedEmail())
            ->from('admin@write_solid.com')
            ->to($user->getEmail())
            ->subject('Confirm your accout')
            ->htmlTemplate('@andrii_write_solid/emails/registration_confirmation.html.twig')
            ->context(['confirmationLink' => $confirmationLink,]);

        $this->mailer->send($confirmationEmail);
    }
}
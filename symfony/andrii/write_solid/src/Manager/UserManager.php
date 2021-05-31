<?php

namespace Write_solid\Manager;

use Exception as ExceptionAlias;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Write_solid\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserManager
{
    private UserPasswordEncoderInterface $passwordEncoder;
    private ManagerRegistry $managerRegistry;
    private ObjectManager $entityManager;
    private RouterInterface $router;
    private MailerInterface $mailer;

    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        ManagerRegistry $managerRegistry,
        RouterInterface $router,
        MailerInterface $mailer
    )
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->managerRegistry = $managerRegistry;
        $this->entityManager = $this->managerRegistry->getManager('andrii_write_solid');
        $this->router = $router;
        $this->mailer = $mailer;
    }

    /**
     * @throws ExceptionAlias
     * @throws TransportExceptionInterface
     */
    public function register(User $user, string $plainPassword): void
    {
        $token = $this->createToken();
        $user->setConfirmationToken($token);

        $confirmationLink = $this->router->generate('andrii_write_solid_check_confirmation_link', [
            'token' => $user->getConfirmationToken(),
        ], UrlGeneratorInterface::ABSOLUTE_PATH);

        $confirmationEmail = (new TemplatedEmail())
            ->from('admin@write_solid.com')
            ->to($user->getEmail())
            ->subject('Confirm your accout')
            ->htmlTemplate('@andrii_write_solid/emails/registration_confirmation.html.twig')
            ->context([
                'confirmationLink' => $confirmationLink,
            ]);

        $user->setPassword(
            $this->passwordEncoder->encodePassword($user, $plainPassword)
        );

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->mailer->send($confirmationEmail);
    }

    /**
     * @throws ExceptionAlias
     */
    private function createToken(): string
    {
        return rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
    }
}

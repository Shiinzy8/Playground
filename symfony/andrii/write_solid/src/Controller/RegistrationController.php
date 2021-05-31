<?php

namespace Write_solid\Controller;

use Write_solid\Entity\User;
use Write_solid\Form\RegistrationFormType;
use Write_solid\Manager\UserManager;
use Write_solid\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Write_solid\Security\ConfitmationEmailsender;

/**
 * Class RegistrationController
 * @package Write_solid\Controller
 */
class RegistrationController extends AbstractController
{
    /**
     * @Route("/signup", name="signup")
     */
    public function signup(Request $request, UserManager $userManager, ConfitmationEmailsender $emailsender)
    {
        $form = $this->createForm(RegistrationFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var $user User */
            $user = $form->getData();
            $user->setUsername($user->getEmail());
            $user->setAgreedToTermsAt(new \DateTime('now'));

            $plainPassword = $form->get('plainPassword')->getData();

            $userManager->create($user, $plainPassword);
            $emailsender->send($user);

            $this->addFlash('success', "Fist Pump! Let's go find some Sasquatch!");

            return $this->redirectToRoute('andrii_write_solid_homepage');
        }

        return $this->render(
            '@andrii_write_solid/registration.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/confirm/{token}", name="check_confirmation_link")
     */
    public function confirmAction(
        string $token,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager
    ): RedirectResponse {
        $user = $userRepository->findOneBy(['confirmationToken' => $token]);

        if (!$user) {
            throw $this->createNotFoundException(
                sprintf('The user with confirmation token "%s" does not exist', $token)
            );
        }

        $user->setConfirmationToken(null);

        $entityManager->flush();

        $this->addFlash('success', 'Your email is confirmed! Let\'s go confirm some Bigfoot!');

        return $this->redirectToRoute('andrii_write_solid_homepage');
    }
}

<?php

namespace Write_solid\Controller;

use Write_solid\Repository\UserRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecurityController
 * @package Write_solid\Controller
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     * @throws Exception
     */
    public function login(AuthenticationUtils $authenticationUtils, UserRepository $userRepository): Response
    {
        if ($this->getUser()) {
            $this->redirectToRoute('andrii_write_solid_homepage');
        }

        $validUser = $userRepository->getSingleUser();

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            '@andrii_write_solid/security/login.html.twig',
            [
                'last_username' => $lastUsername,
                'error' => $error,
                'validUser' => $validUser
            ]
        );
    }

    /**
     * @Route("/logout", name="logout")
     * @throws Exception
     */
    public function logout()
    {
        throw new Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
}

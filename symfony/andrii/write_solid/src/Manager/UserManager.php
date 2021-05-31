<?php

namespace Write_solid\Manager;

use Exception as ExceptionAlias;
use Write_solid\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserManager
{
    private UserPasswordEncoderInterface $passwordEncoder;
    private ManagerRegistry $managerRegistry;
    private ObjectManager $entityManager;

    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        ManagerRegistry $managerRegistry
    )
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->managerRegistry = $managerRegistry;
        $this->entityManager = $this->managerRegistry->getManager('andrii_write_solid');
    }

    /**
     * @throws ExceptionAlias
     */
    public function create(User $user, string $plainPassword): void
    {
        $token = $this->createToken();
        $user->setConfirmationToken($token);

        $user->setPassword(
            $this->passwordEncoder->encodePassword($user, $plainPassword)
        );

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    /**
     * @throws ExceptionAlias
     */
    private function createToken(): string
    {
        return rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
    }
}

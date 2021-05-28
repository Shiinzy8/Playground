<?php

namespace Write_solid\DataFixtures;

use Write_solid\Entity\BigFootSighting;
use Write_solid\Entity\Comment;
use Write_solid\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class WriteSolidFixtures
 * @package Write_solid\DataFixtures
 */
class WriteSolidFixtures extends Fixture
{
    private UserPasswordEncoderInterface $passwordEncoder;
    private ObjectManager $objectManager;
    private Generator $faker;

    /** @var User[] */
    private array $users = [];
    /** @var BigFootSighting[] */
    private array $sightings = [];

    /**
     * WriteSolidFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->objectManager = $manager;
        $this->faker = Factory::create();

        $this->createUsers();
        $this->createSightings();
        $this->createComments();

        $manager->flush();
    }

    private function createUsers()
    {
        $this->users = $this->createMany(
            5,
            function () {
                $user = new User();
                $user->setUsername($this->faker->userName);
                $user->setEmail($user->getUsername() . '@example.com');
                $user->setPassword(
                    $this->passwordEncoder->encodePassword($user, 'believe')
                );
                $user->setAgreedToTermsAt($this->faker->dateTimeBetween('-6 months'));

                return $user;
            }
        );
    }

    private function createSightings()
    {
        $this->sightings = $this->createMany(
            50,
            function () {
                $sighting = new BigFootSighting();
                $sighting->setOwner($this->users[array_rand($this->users)]);
                $sighting->setTitle($this->faker->realText(80));
                $sighting->setDescription($this->faker->paragraph);
                $sighting->setScore(rand(1, 10));
                $sighting->setLatitude($this->faker->latitude);
                $sighting->setLongitude($this->faker->longitude);
                $sighting->setCreatedAt($this->faker->dateTimeBetween('-6 months'));

                return $sighting;
            }
        );
    }

    private function createComments()
    {
        $this->createMany(
            200,
            function (int $i) {
                $comment = new Comment();
                if ($i % 5 === 0) {
                    // make every 5th comment done by a small set of users
                    // Wow! They must *love* Bigfoot!
                    $rangeMax = floor(count($this->users) / 10);
                    $comment->setOwner($this->users[rand(0, $rangeMax)]);
                } else {
                    $comment->setOwner($this->users[array_rand($this->users)]);
                }
                $comment->setBigFootSighting($this->sightings[array_rand($this->sightings)]);
                $comment->setContent($this->faker->paragraph);
                $comment->setCreatedAt($this->faker->dateTimeBetween($comment->getBigFootSighting()->getCreatedAt()));

                return $comment;
            }
        );
    }

    /**
     * @param int $amount
     * @param callable $callback
     * @return array
     */
    private function createMany(int $amount, callable $callback): array
    {
        $objects = [];
        for ($i = 0; $i < $amount; $i++) {
            $object = $callback($i);
            $this->objectManager->persist($object);

            $objects[] = $object;
        }
        $this->objectManager->flush();

        return $objects;
    }
}

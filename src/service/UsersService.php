<?php


namespace App\service;

use App\Entity\StatsBio;
use App\Entity\Users;
use App\Repository\StatsBioRepository;
use App\Repository\UsersRepository;
use Doctrine\DBAL\Exception\DriverException;
use Doctrine\DBAL\Exception\NotNullConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersService
{
    private UserPasswordEncoderInterface $passwordHasher;

    public function __construct(UserPasswordEncoderInterface $passwordHasher, UsersRepository $usersRepository, StatsBioRepository $statsBioRepository)
    {
        $this->passwordHasher = $passwordHasher;
        $this->userRepository = $usersRepository;
        $this->statsBioRepository = $statsBioRepository;
    }

    public function createUser(Request $request, EntityManagerInterface $manager)
    {
        $e = array();
        $data = json_decode($request->getContent(), true);
        $email = $data['email'] ?? $e = array_push($e, 'Firstname null');
        $password = $data['password'] ?? $e = array_push($e, 'Firstname null');

        $user = new Users();
        $stats = new StatsBio();
        $user
            ->setMail($email)
            ->setPassword($this->passwordHasher->encodePassword($user, $password));
        $user->setStatsBioIdStatsBio($stats);
        $stats->setCreatedAt(new \DateTime('now'));
        $manager->persist($user);
        $manager->persist($stats);

        if (array_count_values($e) > 0) {
            return new JsonResponse([$e], Response::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            $manager->flush();
            return new JsonResponse(['status' => 'User Created'], Response::HTTP_CREATED);
        }

    }

    public function updateUserStats(int $userId, Request $request, EntityManagerInterface $manager)
    {
        $e = array();
        $data = json_decode($request->getContent(), true);
        $firstname = $data['firstname'] ?? $e = array_push($e, 'Firstname null');
        $lastname = $data['lastname'] ?? $e = array_push($e, 'lastname null');
        $weight = $data['weight'] ?? $e = array_push($e, 'weight null');
        $height = $data['height'] ?? $e = array_push($e, 'height null');
        $gender = $data['gender'] ?? $e = array_push($e, 'gender null');

        $user = $this->userRepository->find($userId);
        $stats = $this->statsBioRepository->findOneBy(['users_idUsers' => $userId]);
        $user
            ->setFirstname($firstname)
            ->setLastname($lastname)
            ->setGender($gender)
            ->setUpdatedAt(new \DateTime('now'));
        $stats->setWeight($weight);
        $stats->setHeight($height);
        $stats->setUpdatedAt(new \DateTime('now'));
        $manager->persist($user);
        $manager->persist($stats);

        if (array_count_values($e) > 0) {
            return new JsonResponse([$e], Response::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            $manager->flush();
            return new JsonResponse(['status' => 'User Updated'], Response::HTTP_OK);
        }

    }
}
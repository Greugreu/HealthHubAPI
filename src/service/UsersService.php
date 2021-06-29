<?php


namespace App\service;

use App\Entity\StatsBio;
use App\Entity\Users;
use App\Repository\StatsBioRepository;
use App\Repository\UsersRepository;
use Doctrine\DBAL\Driver\SQLSrv\Exception\Error;
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
    private UsersRepository $userRepository;
    private StatsBioRepository $statsBioRepository;

    public function __construct(UserPasswordEncoderInterface $passwordHasher, UsersRepository $usersRepository, StatsBioRepository $statsBioRepository)
    {
        $this->passwordHasher = $passwordHasher;
        $this->userRepository = $usersRepository;
        $this->statsBioRepository = $statsBioRepository;
    }

    /**
     * @throws \JsonException
     */
    public function createUser(Request $request, EntityManagerInterface $manager): JsonResponse
    {
        $e = array();
        $user = new Users();
        $stats = new StatsBio();

        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return new JsonResponse(['status' => 'Error on payload', Response::HTTP_BAD_REQUEST]);
        } else {
            ($data['email'] != null) ? $user->setMail($data['email']) : array_push($e, 'mail null');

            ($data['password'] != null) ? $user->setPassword($this->passwordHasher->encodePassword($user, $data['password'])) : array_push($e, 'password null');

            if (count($e) > 0) {
                return new JsonResponse([$e], Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $user->setStatsBioIdStatsBio($stats);
                $stats->setCreatedAt(new \DateTime('now'));
                $manager->persist($user);
                $manager->persist($stats);
                $manager->flush();
                return new JsonResponse(['status' => 'User Created'], Response::HTTP_CREATED);
            }
        }
    }

    /**
     * @throws \JsonException
     * @throws Error
     */
    public function updateUserStats(int $userId, Request $request, EntityManagerInterface $manager): JsonResponse
    {
        $e = array();
        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return new JsonResponse(['status' => 'Error on payload', Response::HTTP_BAD_REQUEST]);
        } else {
            $firstname = $data['firstname'] ?? array_push($e, 'Firstname null');
            $lastname = $data['lastname'] ?? array_push($e, 'lastname null');
            $weight = $data['weight'] ?? array_push($e, 'weight null');
            $height = $data['height'] ?? array_push($e, 'height null');
            $gender = $data['gender'] ?? array_push($e, 'gender null');

            $user = $this->userRepository->find($userId);
            $stats = $this->statsBioRepository->findOneBy(['users_idUsers' => $userId]);

            if ($user == null) {
                return new JsonResponse(['status' => 'User not found', Response::HTTP_INTERNAL_SERVER_ERROR]);
            } elseif ($stats == null) {
                return new JsonResponse(['status' => 'User stats not found'], Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                try {
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
                } catch (\Exception $exception) {
                    throw new Error($exception->getMessage());
                }
            }

            if (count($e) > 0) {
                return new JsonResponse([$e], Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $manager->flush();
                return new JsonResponse(['status' => 'User Updated'], Response::HTTP_OK);
            }
        }

    }
}
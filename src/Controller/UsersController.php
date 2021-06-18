<?php

namespace App\Controller;

use App\Entity\StatsBio;
use App\Entity\Users;
use App\Repository\StatsBioRepository;
use App\Repository\UsersRepository;
use App\service\UsersService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\User;

class UsersController extends AbstractController
{

    private EntityManagerInterface $manager;
    private UsersService $userService;

    public function __construct(EntityManagerInterface $manager,
                                UsersService $usersService)
    {
        $this->manager = $manager;
        $this->userService = $usersService;}

    /**
     * @Route("/users/new", name="createUser", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function createUser(Request $request): Response
    {
        return $this->createUser($request);
    }

    /**
     * @Route("/users/update", name="updateUser", methods={"PUT"})
     * @param Request $request
     * @param $userId
     * @return Response
     */
    public function updateUserSignup(Request $request, $userId): Response
    {
        return $this->userService->updateUserStats($userId, $request, $this->manager);
    }

    /**
     * @Route("/users/login", name="loginUser", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function login(Request $request): Response
    {

    }

    /**
     * @Route("/users", name="users")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UsersController.php',
        ]);
    }
}

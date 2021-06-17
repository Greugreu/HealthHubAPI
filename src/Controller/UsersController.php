<?php

namespace App\Controller;

use App\Entity\StatsBio;
use App\Entity\Users;
use App\service\UsersService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{

    private EntityManagerInterface $manager;
    private UsersService $userService;

    public function __construct(EntityManagerInterface $manager, UsersService $usersService)
    {
        $this->manager = $manager;
        $this->userService = $usersService;
    }

    /**
     * @Route("/users/new", name="createUser", methods={"POST"})
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function createUser(Request $request): Response
    {
        try {
            $response = $this->userService->createUser($request, $this->manager);
        } catch (Exception $e) {
            throw $e;
        }

        return $response;
    }

    /**
     * @Route("/users/update", name="updateUser", methods={"PUT"})
     * @param Request $request
     * @param $userId
     * @return Response
     * @throws Exception
     */
    public function updateUserSignup(Request $request, $userId): Response
    {
        try {
            $response = $this->userService->updateUserStats($userId, $request, $this->manager);
        } catch (Exception $e)
        {
            throw $e;
        }

        return $response;
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

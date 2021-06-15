<?php

namespace App\Controller;

use App\Entity\StatsBio;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{

    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/users/new", name="createUser", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function createUser(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        print_r($data);
            $firstname = $data['username'];
            $lastName = $data['lastname'];
            $email = $data['email'];
            $password = $data['password'];
            $gender = $data['gender'];

        try {
            if (!empty($firstname) && !empty($lastName) && !empty($email) && !empty($password) && !empty($gender)) {
                $user = new Users();
                $stats = new StatsBio();
                $user->setFirstname($firstname)
                    ->setLastname($lastName)
                    ->setMail($email)
                    ->setPassword($password)
                    ->setGender($gender);
                $user->setStatsBioIdStatsBio($stats);
                $this->manager->persist($user);
                $this->manager->flush();
            }
        } catch (NotFoundHttpException $e){
            throw $e;
        }

        return new JsonResponse(['status' => 'User Created'], Response::HTTP_CREATED);
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

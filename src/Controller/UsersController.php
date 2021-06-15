<?php

namespace App\Controller;

use App\Entity\StatsBio;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("create/user", name="createUser", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function createUser(Request $request): Response
    {
        $firstname = $request->request->get('firstname');
        $lastName = $request->request->get('lastname');
        $email = $request->request->get('mail');
        $password = $request->request->get('password');
        $gender = $request->request->get('gender');


        $response = new Response();

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

                $response->setStatusCode(201);
            } else {
                $response->setStatusCode(400);


            }
        }
        catch (NotFoundHttpException $e){
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

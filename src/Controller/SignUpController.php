<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SignUpController extends AbstractController
{
    private EntityManagerInterface $manager;
    private UsersRepository $userRepos;

    public function __construct(EntityManagerInterface $manager, UsersRepository $userRepos)
    {
        $this->manager = $manager;
        $this->userRepos = $userRepos;
    }

    /**
     * @Route("/signup", name="signup")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/SignUpController.php',
        ]);
    }

    /**
     * @Route("/signup/new", name="newUser")
     */
    public function signup($manager, $userRepos): Response
    {

    }

}

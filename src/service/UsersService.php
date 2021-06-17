<?php


namespace App\service;


use App\Entity\StatsBio;
use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersService
{
    private $passwordHasher;
    public function __construct(UserPasswordEncoderInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function createUser(Request $request, EntityManagerInterface $manager)
    {

        $data = json_decode($request->getContent(), true);
        $email = $data['email'];
        $password = $data['password'];

        try {
            if (!empty($email) && !empty($password)) {
                $user = new Users();
                $stats = new StatsBio();
                $user
                    ->setMail($email)
                    ->setPassword($this->passwordHasher->encodePassword($user, $password));
                $user->setStatsBioIdStatsBio($stats);
                $stats->setCreatedAt(new \DateTime('now'));
                $manager->persist($user);
                $manager->flush();
            }
        } catch (NotFoundHttpException $e){
            throw $e;
        }
    }
}
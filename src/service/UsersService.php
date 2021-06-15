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

class UsersService
{
    public function createUser(Request $request, EntityManagerInterface $manager)
    {
        $data = json_decode($request->getContent(), true);
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
                $manager->persist($user);
                $manager->flush();
            }
        } catch (NotFoundHttpException $e){
            throw $e;
        }
    }
}
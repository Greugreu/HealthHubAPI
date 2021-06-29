<?php


namespace App\service;


use App\Entity\StatsBio;
use App\Repository\StatsBioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class StatsBioService
{

    public function __construct(StatsBioRepository $statsBioRepository)
    {
        $this->statsBioRepository = $statsBioRepository;
    }

    public function createImc(Request $request, EntityManagerInterface $manager): JsonResponse
    {
        $e = [];
        $data = json_decode($request->getContent(), true);
        if (!empty($data['weight']) && !empty($data['height']) && !empty($data['age']) && !empty($data['gender'])) {
            $height = $data['height'];
            $weight = $data['weight'];
            $age = $data['age'];
            $gender = $data['gender'];
            $imc = ($weight * 10000) / ($height * $height);
            if ($gender == 1) {
                $mb = (0.963 * $weight ** 0.48 * ($height / 100) ** 0.5 * $age ** -0.13) * 238.92;
            } else {
                $mb = (1.083 * $weight ** 0.48 * ($height / 100) ** 0.50 * $age ** -0.13) * 238.92;
            }

            if ($data['NAP'] === 1) {
                $nap = 1.4;
            } elseif ($data['NAP'] == 2) {
                $nap = 1.6;
            } elseif ($data['NAP'] == 3) {
                $nap = 1.7;
            } else {
                $nap = undefined;
            }

            $dej = $mb * $nap;

            if ($data['Goal'] === 1) {
                $goal = $dej - 250;
            } elseif ($data['NAP'] == 2) {
                $goal = $dej + 250;
            } elseif ($data['NAP'] == 3) {
                $goal = $dej;
            } else {
                $goal = undefined;
            }

            $stats = new StatsBio();
            $stats
                ->setHeight($height)
                ->setWeight($weight)
                ->setImc(round($imc, 1))
                ->setGender($gender)
                ->setAge($age)
                ->setMB(round($mb, 0))
                ->setDEJ(round($dej, 0))
                ->setNAP($nap)
                ->setGoal(round($goal, 0))
                ->setCreatedAt(new \DateTime());
            $manager->persist($stats);
        } else {
            $e[] = 'pas de data';
        }


        if (count($e) > 0) {
            return new JsonResponse([$e], Response::HTTP_INTERNAL_SERVER_ERROR);

        } else {
            $manager->flush();
            return new JsonResponse(['status' => 'Stats bio created'], Response::HTTP_CREATED);
        }

    }

    public function createMB(Request $request, EntityManagerInterface $manager)
    {

    }
}
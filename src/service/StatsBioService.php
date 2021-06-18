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

    public function createImc(Request $request, EntityManagerInterface $manager)
    {
        $e = [];
        $data = json_decode($request->getContent(), true);
        dump($request->getContent());
        if (!empty($data['weight']) && !empty($data['height'])) {
            $height = $data['height'];
            $weight = $data['weight'];
            $imc = ($weight * 10000) / ($height * $height);
            $stats = new StatsBio();
            $stats
                ->setHeight($height)
                ->setWeight($weight)
                ->setImc($imc)
                ->setCreatedAt(new \DateTime());
            $manager->persist($stats);
        } else {
            $e[] = 'pas de data';
        }


        if (count($e) > 0) {
            return new JsonResponse([$e], Response::HTTP_INTERNAL_SERVER_ERROR);

        } else {
            $manager->flush();
            return new JsonResponse(['status' => 'IMC created'], Response::HTTP_CREATED);
        }

    }
}
<?php

namespace App\Controller;

use App\service\StatsBioService;
use Exception;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatsBioController extends AbstractController
{
    private EntityManagerInterface $manager;
    private StatsBioService $statsService;
    public function __construct(EntityManagerInterface $manager, StatsBioService $statsService)
    {
        $this->manager = $manager;
        $this->statsService = $statsService;
    }

    /**
     * @Route("/stats/new", name="createImc", methods={"POST"})
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function createStats(Request $request): Response
    {
        try {
            $response = $this->statsService->createImc($request, $this->manager);
        } catch (Exception $e) {
            throw $e;
        }

        return $response;
    }

    /**
     * @Route("/stats/bio", name="stats_bio")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/StatsBioController.php',
        ]);
    }
}

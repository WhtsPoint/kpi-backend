<?php

namespace App\Controller;

use App\Interface\HealthServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HealthController extends AbstractController
{
    public function __construct(
        protected HealthServiceInterface $service
    ) {}

    #[Route('/api/healthcheck', methods: 'GET')]
    public function check(): JsonResponse
    {
        $data = $this->service->check();

        return $this->json($data);
    }
}
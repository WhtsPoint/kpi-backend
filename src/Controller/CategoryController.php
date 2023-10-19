<?php

namespace App\Controller;

use App\Dto\CategoryCreationDto;
use App\Exception\CategoryNotFoundException;
use App\Exception\CategoryNotFoundHttpException;
use App\Interface\CategoryServiceInterface;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    public function __construct(
        protected CategoryServiceInterface $service,
        protected CategoryRepository $repository
    ) {}

    #[Route('/api/category', methods: 'POST')]
    public function create(
        #[MapRequestPayload] CategoryCreationDto $dto
    ): JsonResponse
    {
        $response = $this->service->create($dto);

        return $this->json($response);
    }

    #[Route('/api/category/{id}', methods: 'GET')]
    public function getById(string $id): JsonResponse
    {
        try {
            $category = $this->repository->getById($id);
        } catch (CategoryNotFoundException) {
            throw new CategoryNotFoundHttpException();
        }

        return $this->json($category);
    }

    #[Route('/api/category/{id}', methods: 'DELETE')]
    public function delete(string $id): JsonResponse
    {
        try {
            $this->repository->delete($id);
        } catch (CategoryNotFoundException) {
            throw new CategoryNotFoundHttpException();
        }

        return $this->json(['success' => true]);
    }
}
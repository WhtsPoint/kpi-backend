<?php

namespace App\Controller;

use App\Dto\UserCreationDto;
use App\Exception\UserNotFoundException;
use App\Exception\UserNotFoundHttpException;
use App\Exception\UserWithThisLoginExistsException;
use App\Exception\UserWithThisLoginExistsHttpException;
use App\Interface\UserRepositoryInterface;
use App\Interface\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function __construct(
        protected UserServiceInterface $service,
        protected UserRepositoryInterface $repository
    ) {}

    #[Route('/api/user', methods: 'POST')]
    public function create(
        #[MapRequestPayload] UserCreationDto $dto
    ): JsonResponse {
        try {
            $response = $this->service->create($dto);
        } catch (UserWithThisLoginExistsException) {
            throw new UserWithThisLoginExistsHttpException();
        }
        return $this->json($response);
    }

    #[Route('/api/user/{id}', methods: 'GET')]
    public function getById(string $id): JsonResponse
    {
        try {
            $user = $this->repository->getById($id);
        } catch (UserNotFoundException) {
            throw new UserNotFoundHttpException();
        }

        return $this->json($user);
    }

    #[Route('/api/user/{id}', methods: 'DELETE')]
    public function delete(string $id): JsonResponse
    {
        try {
            $this->service->deleteById($id);
        } catch (UserNotFoundException) {
            throw new UserNotFoundHttpException();
        }

        return $this->json(['success' => true]);
    }

    #[Route('/api/users', methods: 'GET')]
    public function getAll(): JsonResponse
    {
        $users = $this->repository->getAll();

        return $this->json($users);
    }
}
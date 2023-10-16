<?php

namespace App\Controller;

use App\Dto\UserCreationDto;
use App\Exception\UserNotFoundException;
use App\Exception\UserNotFoundHttpException;
use App\Interface\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function __construct(
        protected UserServiceInterface $service
    ) {}

    #[Route('/api/user', methods: 'POST')]
    public function create(Request $request): JsonResponse
    {
        $payload = $request->getPayload();
        $dto = new UserCreationDto(
            $payload->get('name') ?: 'Noname'
        );

        $result = $this->service->create($dto);

        return $this->json($result);
    }

    #[Route('/api/user/{id}', methods: 'GET')]
    public function getById(string $id): JsonResponse
    {
        try {
            $user = $this->service->getById($id);
        } catch (UserNotFoundException) {
            throw new UserNotFoundHttpException();
        }

        return $this->json($user);
    }

    #[Route('/api/user/{id}', methods: 'DELETE')]
    public function delete(string $id): JsonResponse
    {
        try {
            $this->service->delete($id);
        } catch (UserNotFoundException) {
            throw new UserNotFoundHttpException();
        }

        return $this->json(['success' => true]);
    }

    #[Route('/api/users', methods: 'GET')]
    public function getAll(): JsonResponse
    {
        $users = $this->service->getAll();

        return $this->json($users);
    }
}
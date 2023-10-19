<?php

namespace App\Controller;

use App\Dto\RecordCreationDto;
use App\Dto\RecordSearchParamsDto;
use App\Exception\CategoryNotFoundException;
use App\Exception\CategoryNotFoundHttpException;
use App\Exception\RecordNotFoundException;
use App\Exception\RecordNotFoundHttpException;
use App\Exception\UserNotFoundException;
use App\Exception\UserNotFoundHttpException;
use App\Interface\RecordRepositoryInterface;
use App\Interface\RecordServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

class RecordController extends AbstractController
{
    public function __construct(
        protected RecordServiceInterface $service,
        protected RecordRepositoryInterface $repository
    ) {}

    #[Route('/api/record', methods: 'POST')]
    public function create(
        #[MapRequestPayload] RecordCreationDto $dto
    ): JsonResponse {
        try {
            $response = $this->service->create($dto);
        } catch (UserNotFoundException) {
            throw new UserNotFoundHttpException();
        } catch (CategoryNotFoundException) {
            throw new CategoryNotFoundHttpException();
        }

        return $this->json($response);
    }

    #[Route('/api/records', methods: 'GET')]
    public function get(
        #[MapRequestPayload] RecordSearchParamsDto $dto
    ): JsonResponse {
        if ($dto->userId === null && $dto->categoryId === null) {
            throw new HttpException(
                422,
                'User id and Category can`t be null in same time'
            );
        }

        $response = $this->repository->get($dto);

        return $this->json($response);
    }

    #[Route('/api/record/{id}', methods: 'DELETE')]
    public function delete(string $id): JsonResponse
    {
        try {
            $this->service->delete($id);
        } catch (RecordNotFoundException) {
            throw new RecordNotFoundHttpException();
        }

        return $this->json(['success' => true]);
    }
}
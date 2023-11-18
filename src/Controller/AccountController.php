<?php

namespace App\Controller;

use App\Dto\AccountCreationDto;
use App\Exception\UserAlreadyHasAccountException;
use App\Exception\UserAlreadyHasAccountHttpException;
use App\Exception\UserNotFoundException;
use App\Exception\UserNotFoundHttpException;
use App\Interface\AccountServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    public function __construct(
        protected AccountServiceInterface $service
    ) {}

    #[Route('/api/account', methods: 'POST')]
    public function createForUser(
        #[MapRequestPayload] AccountCreationDto $dto
    ): JsonResponse {
        try {
            $result = $this->service->createForUser($dto);
        } catch (UserNotFoundException) {
            throw new UserNotFoundHttpException();
        } catch (UserAlreadyHasAccountException) {
            throw new UserAlreadyHasAccountHttpException();
        }

        return $this->json($result);
    }
}
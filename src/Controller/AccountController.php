<?php

namespace App\Controller;

use App\Dto\AccountCreationDto;
use App\Dto\TopUpAccountDto;
use App\Exception\AccountNotFoundException;
use App\Exception\AccountNotFoundHttpException;
use App\Exception\InvalidAdditionToBillException;
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
            $response = $this->service->createForUser($dto);
        } catch (UserNotFoundException) {
            throw new UserNotFoundHttpException();
        } catch (UserAlreadyHasAccountException) {
            throw new UserAlreadyHasAccountHttpException();
        }

        return $this->json($response);
    }

    /**
     * @throws InvalidAdditionToBillException
     */
    #[Route('/api/account/top-up', methods: 'PATCH')]
    public function topUp(
        #[MapRequestPayload] TopUpAccountDto $dto
    ): JsonResponse {
        try {
            $response = $this->service->topUp($dto);
        } catch (AccountNotFoundException) {
            throw new AccountNotFoundHttpException();
        }

        return $this->json($response);
    }
}
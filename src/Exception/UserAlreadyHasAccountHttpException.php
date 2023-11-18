<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserAlreadyHasAccountHttpException extends BadRequestHttpException
{
    public const MESSAGE = 'Account with this user id is already exists';

    public function __construct(
        \Throwable $previous = null,
        int $code = 0,
        array $headers = []
    ) {
        parent::__construct(self::MESSAGE, $previous, $code, $headers);
    }
}
<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class NoUserAccountHttpException extends BadRequestHttpException
{
    public const MESSAGE = 'User has no account';

    public function __construct(
        \Throwable $previous = null,
        int $code = 0,
        array $headers = []
    ) {
        parent::__construct(self::MESSAGE, $previous, $code, $headers);
    }
}
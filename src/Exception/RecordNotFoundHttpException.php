<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RecordNotFoundHttpException extends NotFoundHttpException
{
    public const MESSAGE = 'Record not found';

    public function __construct(
        \Throwable $previous = null,
        int $code = 0,
        array $headers = []
    ) {
        parent::__construct(self::MESSAGE, $previous, $code, $headers);
    }
}
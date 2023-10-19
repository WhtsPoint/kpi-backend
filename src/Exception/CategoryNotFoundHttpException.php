<?php

namespace App\Exception;

use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryNotFoundHttpException extends NotFoundHttpException
{
    public const MESSAGE = 'Category not found';

    public function __construct(
        \Throwable $previous = null,
        int $code = 0,
        array $headers = []
    ) {
        parent::__construct(self::MESSAGE, $previous, $code, $headers);
    }
}
<?php

namespace App\Interface;

use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\HttpException;

interface MapperInterface
{
    /**
     * @template T
     * @param class-string<T> $classname
     * @return T
     * @throws InvalidArgumentException
     */
    public function map(
        string $classname,
        array $data,
        array $rules
    ): mixed;

    /**
     * @template T
     * @param class-string<T> $classname
     * @throws HttpException
     * @return T
     */
    public function mapWithHttpException(
        string $classname,
        array $data,
        array $rules
    ): mixed;
}
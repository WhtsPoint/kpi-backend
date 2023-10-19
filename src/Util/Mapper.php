<?php

namespace App\Util;

use App\Interface\MapperInterface;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Mapper implements MapperInterface
{
    public function __construct(
        protected ValidatorInterface $validator,
        protected DenormalizerInterface $denormalizer
    ) {}

    /**
     * @template T
     * @param class-string<T> $classname
     * @return T
     * @throws ExceptionInterface
     */
    public function map(
        string $classname,
        array $data,
        array $rules
    ): mixed {
        $class = $this->denormalizer->denormalize($data, $classname);
        $errors = $this->validator->validate($class, $rules);

        if (count($errors) > 0) {
            throw new InvalidArgumentException('Validation errors');
        }

        return $class;
    }

    /**
     * @template T
     * @param class-string<T> $classname
     * @return T
     * @throws ExceptionInterface
     */
    public function mapWithHttpException(
        string $classname,
        array $data,
        array $rules
    ): mixed {
        try {
            return $this->map($classname, $data, $rules);
        } catch (InvalidArgumentException) {
            throw new HttpException(422, 'Invalid params');
        }
    }
}
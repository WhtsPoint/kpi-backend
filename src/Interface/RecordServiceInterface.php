<?php

namespace App\Interface;

use App\Dto\RecordCreationDto;
use App\Dto\RecordCreationResultDto;
use App\Exception\CategoryNotFoundException;
use App\Exception\RecordNotFoundException;
use App\Exception\UserNotFoundException;

interface RecordServiceInterface
{
    /**
     * @throws UserNotFoundException
     * @throws CategoryNotFoundException
     */
    public function create(RecordCreationDto $dto): RecordCreationResultDto;

    /**
     * @throws RecordNotFoundException
     */
    public function delete(string $id);
}
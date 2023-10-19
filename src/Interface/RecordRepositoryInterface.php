<?php

namespace App\Interface;

use App\Dto\RecordSearchParamsDto;
use App\Entity\Record;
use App\Exception\RecordNotFoundException;

interface RecordRepositoryInterface
{
    public function create(Record $record): void;
    /**
     * @throws RecordNotFoundException
     */
    public function getById(string $id): Record;
    /**
     * @return array<Record>
     */
    public function get(RecordSearchParamsDto $dto): array;
    public function delete(Record $record): void;
}
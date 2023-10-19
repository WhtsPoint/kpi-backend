<?php

namespace App\Interface;

use App\Dto\RecordCreationDto;
use App\Entity\Record;

interface RecordFactoryInterface
{
    public function create(int $amountSpent): Record;
}
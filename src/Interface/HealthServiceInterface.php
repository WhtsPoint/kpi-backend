<?php

namespace App\Interface;

use App\Dto\HealthcheckDto;

interface HealthServiceInterface
{
    public function check(): HealthcheckDto;
}
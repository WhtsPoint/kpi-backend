<?php

namespace App\Service;

use App\Dto\HealthcheckDto;
use App\Interface\HealthServiceInterface;
use DateTimeImmutable;

class HealthService implements HealthServiceInterface
{
    public function check(): HealthcheckDto
    {
        $date = (new DateTimeImmutable())->format('d.m.Y H:i');

        return new HealthcheckDto($date, 'alive🙏🏻');
    }
}
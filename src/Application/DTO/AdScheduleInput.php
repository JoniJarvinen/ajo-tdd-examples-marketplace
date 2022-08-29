<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Application\DTO;

use Ajo\Tdd\Examples\Common\Infrastructure\Time\DateTime;

class AdScheduleInput
{
    public DateTime $startDate;
    public DateTime $endDate;
}
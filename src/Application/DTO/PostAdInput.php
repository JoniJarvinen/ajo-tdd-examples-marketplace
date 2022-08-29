<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Application\DTO;

class PostAdInput
{
    public function __construct(
        public ?string $title = null,
        public ?string $createdByUserId = null,
        public ?string $accountId = null,
        public ?float $price = null,
        public ?AdScheduleInput $adSchedule = null
    ) {
    }
}

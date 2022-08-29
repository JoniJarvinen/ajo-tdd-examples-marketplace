<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Application\DTO;

class PostAdOutput
{
    public function __construct(
        public ?string $adId = null
    ) {
    }
}

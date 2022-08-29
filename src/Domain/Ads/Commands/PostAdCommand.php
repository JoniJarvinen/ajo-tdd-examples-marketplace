<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain\Ads\Commands;

use Brick\Money\Money;

class PostAdCommand
{
    public function __construct(
        public readonly string $accountId,
        public readonly string $userId,
        public readonly Money $price
    ) {
    }
}

class AdDetails
{
    public function __construct(
        public readonly Money $askPrice,
        public readonly array $adAttributes,
        public readonly string $title
    )
    {
    }
}
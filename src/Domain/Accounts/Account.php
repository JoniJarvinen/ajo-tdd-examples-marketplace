<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain\Accounts;

final class Account
{
    public function __construct(private ?AccountId $id)
    {
        # code...
    }
}
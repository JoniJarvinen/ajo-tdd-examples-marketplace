<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain\Accounts;

use InvalidArgumentException;

final class AccountId
{
    public function __construct(private string $id)
    {
        if (mb_strlen($id) < 1) {
            throw new InvalidArgumentException('ID cannot be an empty string');
        }
    }
}
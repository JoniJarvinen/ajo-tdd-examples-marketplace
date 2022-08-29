<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain\Accounts;

use ArrayObject;
use TypeError;

class AccountCollection extends ArrayObject
{
    public function __construct(Account ...$ads)
    {
        return parent::__construct($ads);
    }

    public function offsetSet(mixed $key, mixed $value): void
    {
        if(!$value instanceof Account)
        {
            throw new TypeError(
                sprintf('Expected type: "%s"', Account::class)
            );
        }
        parent::offsetSet($key, $value);
    }

    public function offsetGet(mixed $key): Account
    {
        return parent::offsetGet($key);
    }
}
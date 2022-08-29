<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain\Users;

use ArrayObject;
use TypeError;

class UserCollection extends ArrayObject
{
    public function __construct(User ...$ads)
    {
        return parent::__construct($ads);
    }

    public function offsetSet(mixed $key, mixed $value): void
    {
        if(!$value instanceof User)
        {
            throw new TypeError(
                sprintf('Expected type: "%s"', User::class)
            );
        }
        parent::offsetSet($key, $value);
    }

    public function offsetGet(mixed $key): User
    {
        return parent::offsetGet($key);
    }
}
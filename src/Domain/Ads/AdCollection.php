<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain\Ads;

use ArrayObject;
use TypeError;

class AdCollection extends ArrayObject
{
    public function __construct(Ad ...$ads)
    {
        return parent::__construct($ads);
    }

    public function offsetSet(mixed $key, mixed $value): void
    {
        if(!$value instanceof Ad)
        {
            throw new TypeError(
                sprintf('Expected type: "%s"', Ad::class)
            );
        }
        parent::offsetSet($key, $value);
    }

    public function offsetGet(mixed $key): Ad
    {
        return parent::offsetGet($key);
    }
}
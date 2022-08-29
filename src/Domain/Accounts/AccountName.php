<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain\Accounts;

use Ajo\Tdd\Examples\Common\ValueObjects\AbstractValueObject;
use InvalidArgumentException;
use Stringable;

class AccountName extends AbstractValueObject implements Stringable
{
    public function __construct(private string $value)
    {
        if(
            mb_strlen($value) < 1 ||
            mb_strlen($value) > 100
        ) {
            throw new InvalidArgumentException('Account name must be between 1 and 100 characters long');
        }
    }

    public function toString(): string
    {
        return (string)$this;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
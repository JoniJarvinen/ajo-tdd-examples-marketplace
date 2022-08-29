<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain\Users;

use Ajo\Tdd\Examples\Common\ValueObjects\AbstractValueObject;
use Stringable;

class FullName extends AbstractValueObject implements Stringable
{
    public function __construct(
        public readonly FirstName $firstName,
        public readonly LastName $lastName
    ) {
        # code...
    }

    public function toString(): string
    {
        return (string)$this;
    }

    public function __toString(): string
    {
        return $this->firstName->toString() . ' ' . $this->lastName->toString();
    }
}

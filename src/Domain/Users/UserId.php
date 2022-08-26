<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain\Users;

use Ajo\Tdd\Examples\Common\Equatable;
use InvalidArgumentException;

final class UserId
{
    public function __construct(private string $id)
    {
        if (mb_strlen($id) < 1) {
            throw new InvalidArgumentException('ID cannot be an empty string');
        }
    }

    public function equals(Equatable $value): bool
    {
        if (!$value instanceof UserId) {
            return false;
        }
        return $this->id === $value->id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
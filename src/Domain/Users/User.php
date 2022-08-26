<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain\Users;

final class User
{
    public function __construct(
        private UserId $userId
    ) {
    }
}

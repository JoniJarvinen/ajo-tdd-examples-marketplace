<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain;

use Ajo\Tdd\Examples\Marketplace\Domain\Users\User;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\UserRepositoryInterface;

class Users
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function registerUser(User $user)
    {

    }
}

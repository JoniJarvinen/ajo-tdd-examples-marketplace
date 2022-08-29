<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain\Users;

interface UserRepositoryInterface
{
    public function nextIdentity(): UserId;
    public function save(User $user): User;
    public function findById(UserId $userId): ?User;
}
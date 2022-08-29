<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Infrastructure\Repositories;

use Ajo\Tdd\Examples\Marketplace\Domain\Users\User;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\UserCollection;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\UserId;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\UserRepositoryInterface;

class InMemoryUserRepository implements UserRepositoryInterface
{

    private array $records = [];

    public function findAll(int $limit = 50, int $page = 1): UserCollection
    {
        $offset = $page * $limit - $limit;
        $output = new UserCollection();
        $output->exchangeArray(
            array_slice(
                $this->records,
                $offset,
                $limit
            )
        );
        return $output;
    }

    public function save(User $user): User
    {
        $this->records[(string)$user->id] = $user;
        return $user;
    }

    public function nextIdentity(): UserId
    {
        static $id;
        $id ??= 0;
        $id++;
        return new UserId((string)$id);
    }

    public function findById(UserId $userId): ?User
    {
        if(isset($this->records[(string)$userId]))
        {
            return $this->records[(string)$userId];
        }
        return null;
    }
    
}
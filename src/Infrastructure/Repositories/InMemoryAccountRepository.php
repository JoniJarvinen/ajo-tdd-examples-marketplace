<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Infrastructure\Repositories;

use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\Account;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountCollection;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountId;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountRepositoryInterface;

class InMemoryAccountRepository implements AccountRepositoryInterface
{

    private array $records = [];

    public function findAll(int $limit = 50, int $page = 1): AccountCollection
    {
        $offset = $page * $limit - $limit;
        $output = new AccountCollection();
        $output->exchangeArray(
            array_slice(
                $this->records,
                $offset,
                $limit
            )
        );
        return $output;
    }

    public function save(Account $account): Account
    {
        $this->records[(string)$account->id] = $account;
        return $account;
    }

    public function nextIdentity(): AccountId
    {
        static $id;
        $id ??= 0;
        $id++;
        return new AccountId((string)$id);
    }

    public function findById(AccountId $accountId): ?Account
    {
        if(isset($this->records[(string)$accountId]))
        {
            return $this->records[(string)$accountId];
        }
        return null;
    }
    
}
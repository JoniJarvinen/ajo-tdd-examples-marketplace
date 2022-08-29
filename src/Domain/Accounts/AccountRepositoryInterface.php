<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain\Accounts;

interface AccountRepositoryInterface
{
    public function save(Account $account) : Account;
    public function nextIdentity() : AccountId;
    public function findById(AccountId $accountId): ?Account;
    public function findAll(int $limit = 50, int $page = 1): AccountCollection;
}
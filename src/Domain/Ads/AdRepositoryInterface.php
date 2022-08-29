<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain\Ads;

use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountId;

interface AdRepositoryInterface
{
    public function save(Ad $ad) : Ad;
    public function nextIdentity() : AdId;
    public function findById(AdId $adId): ?Ad;
    public function findByAccountId(AccountId $accountId): AdCollection;
    public function findAll(int $limit = 50, int $page = 1): AdCollection;
}
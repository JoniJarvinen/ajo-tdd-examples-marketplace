<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain\Ads;

use Ajo\Tdd\Examples\Common\Equatable;
use Ajo\Tdd\Examples\Common\Infrastructure\Time\DateTime;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountId;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\UserId;

final class Ad implements Equatable
{
    public function __construct(
        public readonly AdId $id,
        public readonly DateTime $createdAt,
        public readonly UserId $createdBy,
        private AccountId $accountId
    ) {
        $createdAt->utc();
    }

    public function equals($value): bool
    {
        if (
            $value === null ||
            !$value instanceof Ad
        ) {
            return false;
        }
        return $this->id->equals($value->id);
    }

    /**
     * Get the value of accountId
     */
    public function getAccountId(): AccountId
    {
        return $this->accountId;
    }
}

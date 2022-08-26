<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain\Ads;

use Ajo\Tdd\Examples\Common\Equatable;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountId;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\UserId;
use DateTime;

final class Ad implements Equatable
{
    public function __construct(
        public readonly AdId $id,
        public readonly ?DateTime $createdAt = null,
        public readonly UserId $createdBy,
        private AccountId $accountId
    ) {
    }

    public function equals(Equatable $value): bool
    {
        if (!$value instanceof Ad) {
            return false;
        }
        return $this->id->equals($value->id);
    }
}

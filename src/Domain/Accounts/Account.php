<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain\Accounts;

use Ajo\Tdd\Examples\Common\Equatable;
use Ajo\Tdd\Examples\Common\Infrastructure\Time\DateTime;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\Ad;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\UserId;

final class Account implements Equatable
{
    public function __construct(
        public readonly AccountId $id,
        private AccountName $name,
        private UserId $ownerId,
        private UserId $createdBy,
        private DateTime $createdAt
    ) {
    }

    public function equals($value): bool
    {
        if (
            $value === null ||
            !$value instanceof Account
        ) {
            return false;
        }
        return $this->id->equals($value->id);
    }

    public function addAd(Ad $ad)
    {
    }
}

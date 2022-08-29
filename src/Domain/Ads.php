<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain;

use Ajo\Tdd\Examples\Common\Infrastructure\Time\DateTime;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountId;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\Ad;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\AdId;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\UserId;

class Ads
{
    public function newAd(AdId $newId, AccountId $accountId, UserId $userId): Ad
    {
        $ad = new Ad(
            id: $newId,
            createdAt: new DateTime('now'),
            createdBy: $userId,
            accountId: $accountId
        );
        return $ad;
    }
}

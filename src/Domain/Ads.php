<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain;

use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountId;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\Ad;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\AdRepositoryInterface;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\UserId;
use DateTime;

class Ads
{
    public function __construct(private AdRepositoryInterface $adRepository)
    {
    }

    public function create(AccountId $accountId, UserId $userId): Ad
    {
        $newId = $this->adRepository->nextIdentity();
        $ad = new Ad(
            id: $newId,
            createdAt: new DateTime('now'),
            createdBy: $userId,
            accountId: $accountId
        );
        return $ad;
    }
}

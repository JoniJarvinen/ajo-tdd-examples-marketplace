<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Tests\Dsl;

use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountId;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\Ad;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\AdId;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\UserId;
use DateTime;
use ReflectionClass;

class Marketplace
{
    public static function Ad(
        ?AdId $id = new AdId('1'),
        ?UserId $createdBy = new UserId('20'),
        ?DateTime $createdAt = new DateTime('now'),
        ?AccountId $accountId = new AccountId('10')
    ): Ad {
        return new Ad(
            id: $id,
            createdAt: $createdAt,
            createdBy: $createdBy,
            accountId: $accountId
        );
    }

    public static function Id(string $id, string $class)
    {
        $idClass = new ReflectionClass($class);
        $instance = $idClass->newInstance($id);
        return $instance;
    }
}

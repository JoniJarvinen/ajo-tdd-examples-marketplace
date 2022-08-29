<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Tests\Dsl;

use Ajo\Tdd\Examples\Common\Domain\Email;
use Ajo\Tdd\Examples\Common\Infrastructure\Time\DateTime;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\Account;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountId;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountName;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\Ad;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\AdId;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\User;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\UserId;

class Marketplace
{
    public static function ad(
        ?AdId $id = new AdId('1'),
        ?UserId $createdBy = new UserId('1'),
        ?DateTime $createdAt = new DateTime('now'),
        ?AccountId $accountId = new AccountId('1')
    ): Ad {
        return new Ad(
            id: $id,
            createdAt: $createdAt,
            createdBy: $createdBy,
            accountId: $accountId
        );
    }

    public static function user(
        ?UserId $id = new UserId('1'),
        ?Email $email = new Email('test-email@test.com.invalid')
    ): User {
        return new User(
            id: $id,
            email: $email
        );
    }

    public static function account(
        ?AccountId $id = new AccountId('1'),
        ?AccountName $name = new AccountName('Test Account'),
        ?UserId $createdBy = new UserId('1'),
        ?UserId $ownerId = new UserId('1'),
        ?DateTime $createdAt = new DateTime('now')
    ): Account {
        return new Account(
            id: $id,
            name: $name,
            createdAt: $createdAt,
            createdBy: $createdBy,
            ownerId: $ownerId
        );
    }
}

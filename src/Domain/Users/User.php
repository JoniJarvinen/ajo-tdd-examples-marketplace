<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain\Users;

use Ajo\Tdd\Examples\Common\Domain\Email;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\Account;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountCollection;

final class User
{
    private array $domainEvents = [];
    public function __construct(
        public readonly UserId $id,
        private Email $email,
        private AccountCollection $accounts = new AccountCollection()
    ) {
    }

    public function assignAccount(Account $account): static
    {
        if(!$this->hasAccount($account))
        {
            $this->accounts->append($account);
            $this->domainEvents[] = 'User was assigned to account ' . $account->id->toString();
        }
        return $this;
    }

    private function hasAccount(Account $account)
    {
        foreach($this->accounts as $usersAccount)
        {
            /**
             * @var Account $usersAccount
             */
            if($account->equals($usersAccount))
            {
                return true;
            }
        }
        return false;
    }
}

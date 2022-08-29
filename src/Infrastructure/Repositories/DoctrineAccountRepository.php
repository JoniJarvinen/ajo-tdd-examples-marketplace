<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Infrastructure\Repositories;

use Ajo\Tdd\Examples\Common\Domain\IdGeneratorInterface;
use Ajo\Tdd\Examples\Common\Infrastructure\Time\DateTime;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\Account;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountId;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountCollection;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountName;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountRepositoryInterface;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\UserId;
use Ajo\Tdd\Examples\Marketplace\Infrastructure\Entities\Account as EntitiesAccount;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class DoctrineAccountRepository extends EntityRepository implements AccountRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private IdGeneratorInterface $idGenerator
    ) {
    }

    public function save(Account $account): Account
    {
        return $account;
    }

    public function nextIdentity(): AccountId
    {
        return new AccountId($this->idGenerator->nextIdentity());
    }

    public function findById(AccountId $accountId): ?Account
    {
        /**
         * @var ?Account $outAccount
         * @var ?EntitiesAccount $accountEntity
         */
        $outAccount = $accountEntity = $this->findOneBy(['id' => $accountId->toString()]);
        if($accountEntity !== null)
        {
            $outAccount = new Account(
                new AccountId($accountEntity->id),
                new AccountName($accountEntity->name),
                new UserId($accountEntity->ownerId),
                new UserId($accountEntity->createdBy),
                new DateTime($accountEntity->createdAt)
            );
        }
        return $outAccount;
    }

    public function findAll(int $limit = 50, int $page = 1): AccountCollection
    {
        return new AccountCollection();
    }
}

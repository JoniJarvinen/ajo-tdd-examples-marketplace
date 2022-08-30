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
use Ajo\Tdd\Examples\Marketplace\Infrastructure\Entities\Account as EntityAccount;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Exception;

final class DoctrineAccountRepository implements AccountRepositoryInterface
{
    private EntityRepository $repository;

    public function __construct(
        private EntityManagerInterface $entityManager,
        private IdGeneratorInterface $idGenerator
    ) {
        $this->repository = $entityManager->getRepository(EntityAccount::class);
    }

    public function save(Account $account): Account
    {
        $existingAccount = $this->repository->findOneBy(
            ['id' => $account->id->toString()]
        );

        $accountEntity = EntityAccount::fromDomainObject($account);

        if ($existingAccount !== null) {
            if (!$account->id->equals(
                new AccountId($existingAccount->id)
            )) {
                throw new Exception('ID values changed during transformation');
            }
            $this->entityManager->detach($existingAccount);
            
        }
        $this->entityManager->persist($accountEntity);
        $this->entityManager->flush();

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
        $outAccount = $accountEntity = $this->repository->findOneBy(['id' => $accountId->toString()]);

        if ($accountEntity !== null) {
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
        $output = new AccountCollection();

        $query = $this->repository
            ->createQueryBuilder('all_accounts')
            ->setFirstResult($page * $limit)
            ->setMaxResults($limit)
            ->getQuery();

        $results = $query->execute();

        if($results !== null && count($results) > 0)
        {
            foreach($results as $accountEntity)
            {
                $account = new Account(
                    new AccountId($accountEntity->id),
                    new AccountName($accountEntity->name),
                    new UserId($accountEntity->ownerId),
                    new UserId($accountEntity->createdBy),
                    new DateTime($accountEntity->createdAt)
                );
                $output->append($account);
            }
        }

        return $output;
    }
}

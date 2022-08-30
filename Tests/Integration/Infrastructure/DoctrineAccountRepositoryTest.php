<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Tests\Integration\Infrastructure;

use Ajo\Tdd\Examples\Common\Infrastructure\UuidGenerator;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountId;
use Ajo\Tdd\Examples\Marketplace\Infrastructure\Entities\Account as EntityAccount;
use Ajo\Tdd\Examples\Marketplace\Infrastructure\Repositories\DoctrineAccountRepository;
use Ajo\Tdd\Examples\Tests\Dsl\Marketplace;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DoctrineAccountRepositoryTest extends KernelTestCase
{
    private DoctrineAccountRepository $repository;
    private EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->repository = new DoctrineAccountRepository(
            $this->entityManager,
            new UuidGenerator()
        );
    }

    protected function tearDown(): void
    {
        $query = $this->entityManager
            ->getRepository(EntityAccount::class)
            ->createQueryBuilder('delete_all')
            ->delete(EntityAccount::class)
            ->where('1=1')
            ->getQuery();

        $query->execute();
        $this->entityManager->flush();
        
        parent::tearDown();
    }
    
    /**
     * @test
     */
    public function should_generate_unique_ids()
    {
        $generatedIds = [];

        for($i = 0; $i < 20; $i++)
        {
            $newId = (string)$this->repository->nextIdentity();

            $this->assertArrayNotHasKey($newId, $generatedIds, sprintf('A duplicate ID of: "%s" was generated', $newId));
            $generatedIds[$newId] = $newId;
        } 
    }

    /**
     * @test
     */
    public function should_find_all_accounts(): void
    {
        $repository = $this->repository;

        $repository->save(
            Marketplace::account(
                id: new AccountId('1')
            )
        );
        $repository->save(
            Marketplace::account(
                id: new AccountId('2')
            )
        );
        $repository->save(
            Marketplace::account(
                id: new AccountId('3')
            )
        );

        $accounts = $repository->findAll();

        $this->assertCount(3, $accounts, 'Expected to find all 3 saved accounts');
    }

    /**
     * @test
     */
    public function should_find_saved_record_by_id(): void
    {
        $accountToFind = Marketplace::account(id: new AccountId('find_me'));
        $account1 = Marketplace::account(id: new AccountId('1'));
        $account2 = Marketplace::account(id: new AccountId('3'));

        $repository = $this->repository;
        $repository->save($accountToFind);
        $repository->save($account1);
        $repository->save($account2);

        $foundAccount = $repository->findById($accountToFind->id);

        $this->assertTrue($accountToFind->equals($foundAccount), sprintf('Saved account with ID: "%s" should match fetched ad with ID: "%s"', $accountToFind->id, $foundAccount?->id));
    }
}
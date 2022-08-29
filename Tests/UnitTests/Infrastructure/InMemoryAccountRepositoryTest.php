<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Tests\UnitTests\Infrastructure;

use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountId;
use Ajo\Tdd\Examples\Marketplace\Infrastructure\Repositories\InMemoryAccountRepository;
use Ajo\Tdd\Examples\Tests\Dsl\Marketplace;
use PHPUnit\Framework\TestCase;

class InMemoryAccountRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function should_find_saved_record_by_id(): void
    {
        $accountToFind = Marketplace::account(id: new AccountId('find_me'));
        $account1 = Marketplace::account(id: new AccountId('1'));
        $account2 = Marketplace::account(id: new AccountId('3'));

        $repository = new InMemoryAccountRepository();
        $repository->save($accountToFind);
        $repository->save($account1);
        $repository->save($account2);

        $foundAccount = $repository->findById($accountToFind->id);

        $this->assertTrue($accountToFind->equals($foundAccount), sprintf('Saved account with ID: "%s" should match fetched ad with ID: "%s"', $accountToFind->id, $foundAccount?->id));
    }

    /**
     * @test
     */
    public function should_generate_unique_ids()
    {
        $repository = new InMemoryAccountRepository();
        $generatedIds = [];

        for($i = 0; $i < 20; $i++)
        {
            $newId = (string)$repository->nextIdentity();

            $this->assertArrayNotHasKey($newId, $generatedIds, sprintf('A duplicate ID of: "%s" was generated', $newId));
            $generatedIds[$newId] = $newId;
        } 
    }

    /**
     * @test
     */
    public function should_find_all_accounts(): void
    {
        $repository = new InMemoryAccountRepository();
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
}
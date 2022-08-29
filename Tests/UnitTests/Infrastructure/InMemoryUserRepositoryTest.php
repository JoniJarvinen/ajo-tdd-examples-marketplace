<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Tests\UnitTests\Infrastructure;

use Ajo\Tdd\Examples\Marketplace\Domain\Users\UserId;
use Ajo\Tdd\Examples\Marketplace\Infrastructure\Repositories\InMemoryUserRepository;
use Ajo\Tdd\Examples\Tests\Dsl\Marketplace;
use PHPUnit\Framework\TestCase;

class InMemoryUserRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function should_find_saved_record_by_id(): void
    {
        $userToFind = Marketplace::user(id: new UserId('find_me'));
        $user1 = Marketplace::user(id: new UserId('1'));
        $user2 = Marketplace::user(id: new UserId('3'));

        $repository = new InMemoryUserRepository();
        $repository->save($userToFind);
        $repository->save($user1);
        $repository->save($user2);

        $foundUser = $repository->findById($userToFind->id);

        $this->assertTrue($userToFind->equals($foundUser), sprintf('Saved account with ID: "%s" should match fetched ad with ID: "%s"', $userToFind->id, $foundUser?->id));
    }

    /**
     * @test
     */
    public function should_generate_unique_ids()
    {
        $repository = new InMemoryUserRepository();
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
    public function should_find_all_users(): void
    {
        $repository = new InMemoryUserRepository();
        $repository->save(
            Marketplace::user(
                id: new UserId('1')
            )
        );
        $repository->save(
            Marketplace::user(
                id: new UserId('2')
            )
        );
        $repository->save(
            Marketplace::user(
                id: new UserId('3')
            )
        );

        $users = $repository->findAll();

        $this->assertCount(3, $users, 'Expected to find all 3 saved users');
    }
}
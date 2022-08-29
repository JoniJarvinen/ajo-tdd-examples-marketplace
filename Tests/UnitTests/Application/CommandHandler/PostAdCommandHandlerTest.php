<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Tests\UnitTests\Application\CommandHandler;

use Ajo\Tdd\Examples\Marketplace\Application\CommandHandler\PostAdCommandHandler;
use Ajo\Tdd\Examples\Marketplace\Application\Exceptions\AccountMissingException;
use Ajo\Tdd\Examples\Marketplace\Application\Exceptions\UserMissingException;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountId;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountRepositoryInterface;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\Ad;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\AdId;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\AdRepositoryInterface;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\Commands\PostAdCommand;
use Ajo\Tdd\Examples\Marketplace\Domain\Marketplace;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\UserId;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\UserRepositoryInterface;
use Ajo\Tdd\Examples\Marketplace\Infrastructure\Repositories\InMemoryAccountRepository;
use Ajo\Tdd\Examples\Marketplace\Infrastructure\Repositories\InMemoryAdRepository;
use Ajo\Tdd\Examples\Marketplace\Infrastructure\Repositories\InMemoryUserRepository;
use Ajo\Tdd\Examples\Tests\Dsl\Marketplace as DslMarketplace;
use Brick\Money\Money;
use PHPUnit\Framework\TestCase;

class PostAdCommandHandlerTest extends TestCase
{
    private PostAdCommandHandler $postAdCommandHandler;
    private AdRepositoryInterface $adRepository;
    private UserRepositoryInterface $userRepository;
    private AccountRepositoryInterface $accountRepository;
    private Ads $ads;
    private Marketplace $marketplace;

    public function setUp(): void
    {
        parent::setUp();

        $this->adRepository = new InMemoryAdRepository();
        $this->userRepository = new InMemoryUserRepository();
        $this->accountRepository = new InMemoryAccountRepository();
        $this->ads = new Ads();
        $this->marketplace = new Marketplace();

        $this->postAdCommandHandler = new PostAdCommandHandler(
            $this->adRepository,
            $this->userRepository,
            $this->accountRepository,
            $this->ads,
            $this->marketplace
        );
    }
    
    /**
     * @test
     */
    public function should_throw_on_missing_account(): void
    {
        $this->accountRepository->save(DslMarketplace::account(id: new AccountId('123')));
        $this->userRepository->save(DslMarketplace::user(id: new UserId('123')));

        $this->expectException(AccountMissingException::class);

        $this->postAdCommandHandler->handle(
            new PostAdCommand(
                'acc_not_exists',
                '123',
                Money::of(600.66, 'EUR')
            )
        );
    }

    /**
     * @test
     */
    public function should_throw_on_missing_user(): void
    {
        $this->accountRepository->save(
            DslMarketplace::account(id: new AccountId('123'))
        );
        $this->userRepository->save(
            DslMarketplace::user(id: new UserId('123'))
        );

        $this->expectException(UserMissingException::class);

        $this->postAdCommandHandler->handle(
            new PostAdCommand(
                '123',
                'not_existing',
                Money::of(600.66, 'EUR')
            )
        );
    }

    /**
     * @test
     */
    public function should_return_ad_id_on_success(): void
    {
        $this->accountRepository->save(
            DslMarketplace::account(id: new AccountId('123'))
        );
        $this->userRepository->save(
            DslMarketplace::user(id: new UserId('123'))
        );

        $output = $this->postAdCommandHandler->handle(
            new PostAdCommand(
                '123',
                '123',
                Money::of(600.66, 'EUR')
            )
        );

        $this->assertNotNull($output->adId, 'No Ad ID returned for the created ad');
    }

    /**
     * @test
     */
    public function should_persist_new_ad(): void
    {
        $this->accountRepository->save(
            DslMarketplace::account(id: new AccountId('123'))
        );
        $this->userRepository->save(
            DslMarketplace::user(id: new UserId('123'))
        );

        $output = $this->postAdCommandHandler->handle(
            new PostAdCommand(
                '123',
                '123',
                Money::of(600.66, 'EUR')
            )
        );

        $ad = $this->adRepository->findById(new AdId($output->adId));
        $this->assertInstanceOf(Ad::class, $ad);
        $this->assertEquals($output->adId, $ad->id->toString(), 'Wrong ad returned from the repository');
    }
}
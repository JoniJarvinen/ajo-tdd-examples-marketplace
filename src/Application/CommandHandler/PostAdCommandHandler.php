<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Application\CommandHandler;

use Ajo\Tdd\Examples\Marketplace\Application\DTO\PostAdOutput;
use Ajo\Tdd\Examples\Marketplace\Application\Exceptions\AccountMissingException;
use Ajo\Tdd\Examples\Marketplace\Application\Exceptions\UserMissingException;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\Account;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountId;
use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\AccountRepositoryInterface;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\AdRepositoryInterface;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\Commands\PostAdCommand;
use Ajo\Tdd\Examples\Marketplace\Domain\Marketplace;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\User;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\UserId;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\UserRepositoryInterface;

class PostAdCommandHandler
{
    public function __construct(
        private AdRepositoryInterface $adRepository,
        private UserRepositoryInterface $userRepository,
        private AccountRepositoryInterface $accountRepository,
        private Ads $ads,
        private Marketplace $marketplace
    ) {
    }

    public function handle(PostAdCommand $command): PostAdOutput
    {
        $user = $this->userRepository->findById(new UserId($command->userId));
        $account = $this->accountRepository->findById(new AccountId($command->accountId));

        if(!$user instanceof User)
        {
            throw new UserMissingException();
        }

        if(!$account instanceof Account)
        {
            throw new AccountMissingException();
        }

        $ad = $this->ads->newAd(
            $this->adRepository->nextIdentity(),
            $account->id,
            $user->id
        );

        $this->adRepository->save($ad);

        $this->marketplace->postAd($ad);

        $output = new PostAdOutput();
        $output->adId = $ad->id->toString();

        return $output;
    }
}

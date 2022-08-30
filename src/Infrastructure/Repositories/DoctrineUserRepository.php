<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Infrastructure\Repositories;

use Doctrine\ORM\EntityManagerInterface;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\User;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\UserId;
use Ajo\Tdd\Examples\Common\Domain\IdGeneratorInterface;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\UserCollection;
use Ajo\Tdd\Examples\Marketplace\Domain\Users\UserRepositoryInterface;
use Doctrine\ORM\EntityRepository;

final class DoctrineUserRepository implements UserRepositoryInterface
{
    private EntityRepository $repository;

    public function __construct(
        private EntityManagerInterface $entityManager,
        private IdGeneratorInterface $idGenerator
    ) {
        $this->repository = $entityManager->getRepository(EntityAccount::class);
    }

    public function save(User $user): User
    {
        return $user;
    }

    public function nextIdentity(): UserId
    {
        return new UserId($this->idGenerator->nextIdentity());
    }

    public function findById(UserId $userId): ?User
    {
        return null;
    }

    public function findAll(int $limit = 50, int $page = 1): UserCollection
    {
        return new UserCollection();
    }
}
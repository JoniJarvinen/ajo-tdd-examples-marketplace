<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Infrastructure\Entities;

use Ajo\Tdd\Examples\Marketplace\Domain\Accounts\Account as DomainAccount;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('accounts')]
final class Account
{
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public static function fromDomainObject(DomainAccount $account): static
    {
        $accountEntity = new static();

        $accountEntity->id = $account->id->toString();
        $accountEntity->createdAt = $account->getCreatedAt();
        $accountEntity->createdBy = $account->getCreatedBy()->toString();
        $accountEntity->name = $account->getName()->toString();
        $accountEntity->ownerId = $account->getOwnerId()->toString();

        return $accountEntity;
    }

    #[Id]
    #[Column(
        name: 'id',
        type: 'string',
        length: 32
    )]
    public string $id;

    #[Column(
        name: 'name',
        type: 'string',
        length: 100
    )]
    public string $name;

    #[ManyToMany(
        targetEntity: User::class,
        mappedBy: 'accounts'
    )]
    public Collection $users;

    #[Column(
        name: 'ownerId',
        type: 'string',
        length: 32
    )]
    public string $ownerId;

    #[Column(
        name: 'createdBy',
        type: 'string',
        length: 32
    )]
    public string $createdBy;

    #[Column(
        name: 'createdAt',
        type: 'datetime',
        updatable: false
    )]
    public DateTime $createdAt;
}
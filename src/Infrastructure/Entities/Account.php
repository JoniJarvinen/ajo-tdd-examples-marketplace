<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Infrastructure\Entities;

use Ajo\Tdd\Examples\Marketplace\Infrastructure\Repositories\DoctrineAccountRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity(DoctrineAccountRepository::class)]
#[Table('accounts')]
class Account
{
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
        inversedBy: 'accounts'
    )]
    public ArrayCollection $users;

    #[Id]
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
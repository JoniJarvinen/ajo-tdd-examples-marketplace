<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Infrastructure\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('users')]
final class User
{
    public function __construct()
    {
        $this->accounts = new ArrayCollection();
    }

    #[Id]
    #[Column('id', 'string', 32)]
    public string $id;

    #[Column('email', 'string', 200)]
    public string $email;

    #[ManyToMany(
        targetEntity: Account::class,
        inversedBy: 'users'
    )]
    #[JoinTable(
        name: 'users_accounts'
    )]
    public Collection $accounts;
}

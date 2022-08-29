<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Infrastructure\Entities;

use Ajo\Tdd\Examples\Marketplace\Infrastructure\Repositories\DoctrineUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;

#[Entity(DoctrineUserRepository::class)]
class User
{
    #[Id]
    #[Column('id', 'string', 32)]
    public string $id;

    #[Column('email', 'string', 200)]
    public string $email;

    #[ManyToMany(targetEntity: 'Account', mappedBy: 'users')]
    public ArrayCollection $accounts;
}

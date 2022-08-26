<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Infrastructure\Repositories;

use Ajo\Tdd\Examples\Marketplace\Domain\Ads\Ad;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\AdId;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\AdRepositoryInterface;

class InMemoryAdRepository implements AdRepositoryInterface
{
    private array $records = [];

    public function save(Ad $ad): Ad
    {
        $this->records[(string)$ad->id] = $ad;
        return $ad;
    }

    public function nextIdentity(): AdId
    {
        static $id;
        $id ??= 0;
        $id++;
        return new AdId((string)$id);
    }

    public function findById(AdId $adId): ?Ad
    {
        if(isset($this->records[(string)$adId]))
        {
            return $this->records[(string)$adId];
        }
        return null;
    }



    // public function findById(AdId $adId): ?Ad
    // {
    //     foreach(array_keys($this->records) as $adId)
    //     {
    //         if(isset($this->records[(string)$adId]))
    //         {
    //             return $this->records[(string)$adId];
    //         }
    //     }
    //     return null;
    // }
}
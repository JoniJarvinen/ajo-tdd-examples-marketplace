<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain\Ads;

use Ajo\Tdd\Examples\Marketplace\Domain\Ads\Ad;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\AdId;

interface AdRepositoryInterface
{
    public function save(Ad $ad) : Ad;
    public function nextIdentity() : AdId;
    public function findById(AdId $adId): ?Ad;
}
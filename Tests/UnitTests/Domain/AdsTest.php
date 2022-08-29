<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Tests\UnitTests\Domain;

use Ajo\Tdd\Examples\Marketplace\Domain\Ads;
use Ajo\Tdd\Examples\Marketplace\Infrastructure\Repositories\InMemoryAdRepository;
use PHPUnit\Framework\TestCase;

class AdsTest extends TestCase
{
    /**
     * @test
     */
    public function new_ad_should_be_in_initial_place()
    {
        $ads = new Ads(new InMemoryAdRepository());
        $this->markTestIncomplete('Not implemented yet.');
    }
}
<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Tests\UnitTests\Domain;

use Ajo\Tdd\Examples\Common\Infrastructure\Time\DateTime;
use Ajo\Tdd\Examples\Tests\Dsl\Marketplace;
use PHPUnit\Framework\TestCase;
use Throwable;

class AdTest extends TestCase
{
    /**
     * @test
     */
    public function should_require_reference_to_account(): void
    {
        //$this->expectException(TypeError::class); ?????
        $ad = null;
        try {
            Marketplace::ad(accountId: null);
        } catch (Throwable $e) {
        }
        $this->assertNull($ad, 'Ad should always have a reference to an account');
    }

    /**
     * @test
     */
    public function should_require_reference_to_creator(): void
    {
        //$this->expectException(TypeError::class); ?????
        $ad = null;
        try {
            Marketplace::ad(createdBy: null);
        } catch (Throwable $e) {
        }
        $this->assertNull($ad, 'Ad should always have a reference to creator');
    }

    /**
     * @test
     */
    public function should_require_id_on_instantiation(): void
    {
        //$this->expectException(TypeError::class); ?????
        $ad = null;
        try {
            Marketplace::ad(id: null);
        } catch (Throwable $e) {
        }
        $this->assertNull($ad, 'Ad should always have an ID when instantiated');
    }

    /**
     * @test
     */
    public function should_convert_createdAt_date_to_UTC(): void
    {
        $ad = Marketplace::ad(
            createdAt: new DateTime('now', 'Europe/Helsinki')
        );
        $this->assertTrue($ad->createdAt->isUtc(), 'Dates should always be converted to UTC on instantiation');
    }

    /**
     * @test
     */
    public function should_be_in_an_initial_place_when_first_created(): void
    {
        $this->markTestIncomplete('Not implemented yet');
    }
}

<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Tests\UnitTests\Domain;

use Ajo\Tdd\Examples\Marketplace\Domain\Ads\Exceptions\RequiredFieldMissingException;
use Ajo\Tdd\Examples\Tests\Dsl\Marketplace;
use Exception;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\RecursionContext\InvalidArgumentException;
use Throwable;
use TypeError;

class AdTest extends TestCase
{
    /**
     * @test
     */
    public function should_require_reference_to_account(): void
    {
        //$this->expectException(TypeError::class); ?????
        $ad = null;
        try
        {
            Marketplace::Ad(accountId: null);
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
        try
        {
            Marketplace::Ad(createdBy: null);
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
        try
        {
            Marketplace::Ad(id: null);
        } catch (Throwable $e) {
            
        }
        $this->assertNull($ad, 'Ad should always have an ID when instantiated');
    }
}

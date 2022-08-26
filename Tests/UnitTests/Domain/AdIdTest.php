<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Tests\UnitTests\Domain;

use Ajo\Tdd\Examples\Marketplace\Domain\Ads\AdId;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AdIdTest extends TestCase
{
    /**
     * @test
     * @dataProvider validIdSet
     */
    public function should_create_ad_id_successfully($validId): void
    {
        // Given
        $errorMessage = '';
        $adId = null;

        // When
        try {
            $adId = new AdId($validId);
        } catch (\Throwable $e) {
            $errorMessage = $e->getMessage();
        }

        // Then
        $this->assertInstanceOf(AdId::class, $adId, sprintf("Failed to create '%s' with valid input of '%s'\nMessage: %s", AdId::class, $validId, $errorMessage));
    }

    /**
     * @test
     * @dataProvider invalidIdSet
     */
    public function should_throw_invalid_argument_exception(string $invalidId): void
    {
        $this->expectException(InvalidArgumentException::class);
        new AdId($invalidId);
    }

    /**
     * @test
     * @dataProvider validIdSet
     */
    public function should_be_considered_equal(string $validId): void
    {
        // Given
        $adId1 = new AdId($validId);
        $adId2 = new AdId($validId);

        // WHEN + THEN
        $this->assertTrue($adId1->equals($adId2), sprintf("Value Objects of type '%s' should be considered equal with values of '%s' and '%s'", AdId::class, $adId1, $adId2));
    }


    private function validIdSet(): array
    {
        return [
            'Only numbers' => ['1234567890'],
            'Only letters' => ['asdfFDSgdfgergrfg'],
            'Includes Dashes' => ['23535-23-2344fgfreY'],
            'Includes Colons' => ['sdf:dsf:fasd'],
            'Includes Underscores' => ['tyJ_tyj_uikjyj']
            //'Random stuff' => ['']
        ];
    }

    private function invalidIdSet(): array
    {
        return [
            'Empty string' => ['']
        ];
    }
}

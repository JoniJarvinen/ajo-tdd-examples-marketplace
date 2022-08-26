<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Tests\UnitTests\Infrastructure;

use Ajo\Tdd\Examples\Marketplace\Domain\Ads\AdId;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\AdRepositoryInterface;
use Ajo\Tdd\Examples\Marketplace\Infrastructure\Repositories\InMemoryAdRepository;
use Ajo\Tdd\Examples\Tests\Dsl\Marketplace;
use PHPUnit\Framework\TestCase;

class InMemoryAdRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function should_find_one_record_by_id(AdRepositoryInterface ...$repositories): void
    {
        $adToFind = Marketplace::Ad(id: new AdId('find_me'));
        $ad1 = Marketplace::Ad(id: new AdId('1'));
        $ad2 = Marketplace::Ad(id: new AdId('3'));

        $repository = new InMemoryAdRepository();
        $repository->save($adToFind);
        $repository->save($ad1);
        $repository->save($ad2);

        $foundAd = $repository->findById($adToFind->id);

        $this->assertTrue($foundAd->equals($adToFind), sprintf('Saved ad with ID: "%s" should match fetched ad with ID: "%s"', $foundAd->id, $adToFind->id));
    }

    /**
     * @test
     */
    public function should_generate_unique_ids()
    {
        $repository = new InMemoryAdRepository();
        $generatedIds = [];

        for($i = 0; $i < 20; $i++)
        {
            $newId = (string)$repository->nextIdentity();

            $this->assertArrayNotHasKey($newId, $generatedIds, sprintf('A duplicate ID of: "%s" was generated', $newId));
            $generatedIds[$newId] = $newId;
        }
        
    }
}
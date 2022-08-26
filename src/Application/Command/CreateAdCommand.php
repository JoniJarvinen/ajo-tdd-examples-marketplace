<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Application\Command;

use Ajo\Tdd\Examples\Marketplace\Domain\Ads\Ad;

final class CreateAdCommand
{
    public function __construct(
        private $accountId,
        private $whoId,
        private $publishScheduleId
    ) { }

    public function execute()
    {
        
    }
}
<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\Domain\Workflow;

interface PlaceInterface
{
    public function getName(): string;
    public function isInitial(): bool;
    public function isCompleted(): bool;
}
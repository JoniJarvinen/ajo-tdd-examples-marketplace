<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain\Ads\Places;

class Draft implements Place
{
    private bool $isInitial = true;
    private bool $isCompleted = false;
    
    public function isInitial(): bool
    {
        return $this->isInitial;
    }
    public function isCompleted(): bool
    {
        return $this->isCompleted;
    }
    public function getPlace(): Draft
    {
        return new self();   
    }
}

interface Place {
    public function getPlace() : Place;
}
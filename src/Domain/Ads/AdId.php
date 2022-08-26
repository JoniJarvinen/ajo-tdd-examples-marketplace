<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Domain\Ads;

use Ajo\Tdd\Examples\Common\Domain\AbstractId;
use Ajo\Tdd\Examples\Common\Equatable;
use InvalidArgumentException;
use Stringable;

final class AdId extends AbstractId implements Stringable
{

}

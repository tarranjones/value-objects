<?php

declare(strict_types=1);

namespace Tarranjones\ValueObjects;

use InvalidArgumentException;
use Stringable;

final readonly class MinInt implements Stringable
{
    public function __construct(
        private int $value,
        private int $min
    ) {
        if ($value < $min) {
            throw new InvalidArgumentException(sprintf('Value %d must be >= %d.', $value, $min));
        }
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function min(): int
    {
        return $this->min;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}

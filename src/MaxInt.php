<?php

declare(strict_types=1);

namespace Tarranjones\ValueObjects;

use InvalidArgumentException;
use Stringable;

final readonly class MaxInt implements Stringable
{
    public function __construct(
        private int $value,
        private int $max
    ) {
        if ($value > $max) {
            throw new InvalidArgumentException(sprintf('Value %d must be <= %d.', $value, $max));
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

    public function max(): int
    {
        return $this->max;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}

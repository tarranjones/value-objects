<?php

declare(strict_types=1);

namespace Tarranjones\ValueObjects;

use InvalidArgumentException;
use Stringable;

final readonly class ClampedInt implements Stringable
{
    public function __construct(
        private int $value,
        private int $min,
        private int $max
    ) {
        if ($min > $max) {
            throw new InvalidArgumentException(sprintf('Min %d must be <= max %d.', $min, $max));
        }

        if ($value < $min || $value > $max) {
            throw new InvalidArgumentException(sprintf('Value %d must be between %d and %d (inclusive).', $value, $min, $max));
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

    public function max(): int
    {
        return $this->max;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}

<?php

declare(strict_types=1);

namespace Tarranjones\ValueObjects;

use InvalidArgumentException;
use Stringable;

final readonly class PositiveInt implements Stringable
{
    public function __construct(
        private int $value
    ) {
        if ($value <= 0) {
            throw new InvalidArgumentException(sprintf('Value must be positive (> 0), got %d.', $value));
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

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}

<?php

declare(strict_types=1);

namespace Tarranjones\ValueObjects;

use InvalidArgumentException;
use Stringable;

final readonly class Ip implements Stringable
{
    private string $value;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(string $value, int $flags = 0, array $options = [])
    {
        $trimmed = trim($value);
        $filterOptions = $options !== [] ? [
            'flags' => $flags,
            'options' => $options,
        ] : $flags;

        if (filter_var($trimmed, FILTER_VALIDATE_IP, $filterOptions) === false) {
            throw new InvalidArgumentException(sprintf('Invalid IP address: "%s".', $trimmed));
        }

        $this->value = $trimmed;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}

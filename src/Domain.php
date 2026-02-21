<?php

declare(strict_types=1);

namespace Tarranjones\ValueObjects;

use InvalidArgumentException;
use Stringable;

final readonly class Domain implements Stringable
{
    private string $value;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(string $value, bool $isHostname = true, array $options = [])
    {
        $trimmed = trim($value);
        $flags = $isHostname ? FILTER_FLAG_HOSTNAME : 0;
        $filterOptions = $options !== [] ? [
            'flags' => $flags,
            'options' => $options,
        ] : $flags;

        if (filter_var($trimmed, FILTER_VALIDATE_DOMAIN, $filterOptions) === false) {
            throw new InvalidArgumentException(sprintf('Invalid domain: "%s".', $trimmed));
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

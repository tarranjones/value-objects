<?php

declare(strict_types=1);

use InvalidArgumentException;
use Tarranjones\ValueObjects\NonNegativeInt;

it('accepts zero', function (): void {
    $int = new NonNegativeInt(0);
    expect($int->value())->toBe(0);
});

it('accepts a positive integer', function (): void {
    $int = new NonNegativeInt(100);
    expect($int->value())->toBe(100);
});

it('throws on a negative integer', function (): void {
    new NonNegativeInt(-1);
})->throws(InvalidArgumentException::class);

it('compares two equal values as equal', function (): void {
    $a = new NonNegativeInt(0);
    $b = new NonNegativeInt(0);
    expect($a->equals($b))->toBeTrue();
});

it('compares two different values as not equal', function (): void {
    $a = new NonNegativeInt(0);
    $b = new NonNegativeInt(1);
    expect($a->equals($b))->toBeFalse();
});

it('casts to string', function (): void {
    $int = new NonNegativeInt(7);
    expect((string) $int)->toBe('7');
});

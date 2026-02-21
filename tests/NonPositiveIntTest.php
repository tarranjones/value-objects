<?php

declare(strict_types=1);

use InvalidArgumentException;
use Tarranjones\ValueObjects\NonPositiveInt;

it('accepts zero', function (): void {
    $int = new NonPositiveInt(0);
    expect($int->value())->toBe(0);
});

it('accepts a negative integer', function (): void {
    $int = new NonPositiveInt(-100);
    expect($int->value())->toBe(-100);
});

it('throws on a positive integer', function (): void {
    new NonPositiveInt(1);
})->throws(InvalidArgumentException::class);

it('compares two equal values as equal', function (): void {
    $a = new NonPositiveInt(0);
    $b = new NonPositiveInt(0);
    expect($a->equals($b))->toBeTrue();
});

it('compares two different values as not equal', function (): void {
    $a = new NonPositiveInt(0);
    $b = new NonPositiveInt(-1);
    expect($a->equals($b))->toBeFalse();
});

it('casts to string', function (): void {
    $int = new NonPositiveInt(-7);
    expect((string) $int)->toBe('-7');
});

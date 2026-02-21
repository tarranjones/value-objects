<?php

declare(strict_types=1);

use InvalidArgumentException;
use Tarranjones\ValueObjects\MinInt;

it('accepts a value equal to the minimum', function (): void {
    $int = new MinInt(3, 3);
    expect($int->value())->toBe(3);
});

it('accepts a value above the minimum', function (): void {
    $int = new MinInt(10, 3);
    expect($int->value())->toBe(10);
});

it('throws when value is below the minimum', function (): void {
    new MinInt(2, 3);
})->throws(InvalidArgumentException::class);

it('exposes the min boundary', function (): void {
    $int = new MinInt(5, 3);
    expect($int->min())->toBe(3);
});

it('compares two equal values as equal', function (): void {
    $a = new MinInt(5, 0);
    $b = new MinInt(5, 0);
    expect($a->equals($b))->toBeTrue();
});

it('compares two different values as not equal', function (): void {
    $a = new MinInt(5, 0);
    $b = new MinInt(6, 0);
    expect($a->equals($b))->toBeFalse();
});

it('casts to string', function (): void {
    $int = new MinInt(42, 10);
    expect((string) $int)->toBe('42');
});

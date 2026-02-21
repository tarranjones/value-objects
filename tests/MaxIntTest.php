<?php

declare(strict_types=1);

use InvalidArgumentException;
use Tarranjones\ValueObjects\MaxInt;

it('accepts a value equal to the maximum', function (): void {
    $int = new MaxInt(10, 10);
    expect($int->value())->toBe(10);
});

it('accepts a value below the maximum', function (): void {
    $int = new MaxInt(5, 10);
    expect($int->value())->toBe(5);
});

it('throws when value exceeds the maximum', function (): void {
    new MaxInt(11, 10);
})->throws(InvalidArgumentException::class);

it('exposes the max boundary', function (): void {
    $int = new MaxInt(5, 10);
    expect($int->max())->toBe(10);
});

it('compares two equal values as equal', function (): void {
    $a = new MaxInt(5, 100);
    $b = new MaxInt(5, 100);
    expect($a->equals($b))->toBeTrue();
});

it('compares two different values as not equal', function (): void {
    $a = new MaxInt(5, 100);
    $b = new MaxInt(6, 100);
    expect($a->equals($b))->toBeFalse();
});

it('casts to string', function (): void {
    $int = new MaxInt(7, 100);
    expect((string) $int)->toBe('7');
});

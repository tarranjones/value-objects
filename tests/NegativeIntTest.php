<?php

declare(strict_types=1);

use InvalidArgumentException;
use Tarranjones\ValueObjects\NegativeInt;

it('accepts a negative integer', function (): void {
    $int = new NegativeInt(-1);
    expect($int->value())->toBe(-1);
});

it('accepts a large negative integer', function (): void {
    $int = new NegativeInt(PHP_INT_MIN);
    expect($int->value())->toBe(PHP_INT_MIN);
});

it('throws on zero', function (): void {
    new NegativeInt(0);
})->throws(InvalidArgumentException::class);

it('throws on a positive integer', function (): void {
    new NegativeInt(1);
})->throws(InvalidArgumentException::class);

it('compares two equal values as equal', function (): void {
    $a = new NegativeInt(-5);
    $b = new NegativeInt(-5);
    expect($a->equals($b))->toBeTrue();
});

it('compares two different values as not equal', function (): void {
    $a = new NegativeInt(-5);
    $b = new NegativeInt(-10);
    expect($a->equals($b))->toBeFalse();
});

it('casts to string', function (): void {
    $int = new NegativeInt(-42);
    expect((string) $int)->toBe('-42');
});

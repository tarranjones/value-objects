<?php

declare(strict_types=1);

use InvalidArgumentException;
use Tarranjones\ValueObjects\PositiveInt;

it('accepts a positive integer', function (): void {
    $int = new PositiveInt(1);
    expect($int->value())->toBe(1);
});

it('accepts a large positive integer', function (): void {
    $int = new PositiveInt(PHP_INT_MAX);
    expect($int->value())->toBe(PHP_INT_MAX);
});

it('throws on zero', function (): void {
    new PositiveInt(0);
})->throws(InvalidArgumentException::class);

it('throws on a negative integer', function (): void {
    new PositiveInt(-1);
})->throws(InvalidArgumentException::class);

it('compares two equal values as equal', function (): void {
    $a = new PositiveInt(5);
    $b = new PositiveInt(5);
    expect($a->equals($b))->toBeTrue();
});

it('compares two different values as not equal', function (): void {
    $a = new PositiveInt(5);
    $b = new PositiveInt(10);
    expect($a->equals($b))->toBeFalse();
});

it('casts to string', function (): void {
    $int = new PositiveInt(42);
    expect((string) $int)->toBe('42');
});

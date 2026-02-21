<?php

declare(strict_types=1);

use InvalidArgumentException;
use Tarranjones\ValueObjects\ClampedInt;

it('accepts a value within the range', function (): void {
    $int = new ClampedInt(5, 1, 10);
    expect($int->value())->toBe(5);
});

it('accepts a value equal to the minimum', function (): void {
    $int = new ClampedInt(1, 1, 10);
    expect($int->value())->toBe(1);
});

it('accepts a value equal to the maximum', function (): void {
    $int = new ClampedInt(10, 1, 10);
    expect($int->value())->toBe(10);
});

it('throws when value is below the minimum', function (): void {
    new ClampedInt(0, 1, 10);
})->throws(InvalidArgumentException::class);

it('throws when value exceeds the maximum', function (): void {
    new ClampedInt(11, 1, 10);
})->throws(InvalidArgumentException::class);

it('throws when min is greater than max', function (): void {
    new ClampedInt(5, 10, 1);
})->throws(InvalidArgumentException::class);

it('exposes the min and max boundaries', function (): void {
    $int = new ClampedInt(5, 1, 10);
    expect($int->min())->toBe(1);
    expect($int->max())->toBe(10);
});

it('compares two equal values as equal', function (): void {
    $a = new ClampedInt(5, 1, 10);
    $b = new ClampedInt(5, 1, 10);
    expect($a->equals($b))->toBeTrue();
});

it('compares two different values as not equal', function (): void {
    $a = new ClampedInt(5, 1, 10);
    $b = new ClampedInt(6, 1, 10);
    expect($a->equals($b))->toBeFalse();
});

it('casts to string', function (): void {
    $int = new ClampedInt(5, 1, 10);
    expect((string) $int)->toBe('5');
});

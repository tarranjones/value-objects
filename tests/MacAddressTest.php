<?php

declare(strict_types=1);

use InvalidArgumentException;
use Tarranjones\ValueObjects\MacAddress;

it('accepts a valid MAC address with colons', function (): void {
    $mac = new MacAddress('00:11:22:33:44:55');
    expect($mac->value())->toBe('00:11:22:33:44:55');
});

it('accepts a valid MAC address with hyphens', function (): void {
    $mac = new MacAddress('00-11-22-33-44-55');
    expect($mac->value())->toBe('00-11-22-33-44-55');
});

it('trims surrounding whitespace', function (): void {
    $mac = new MacAddress('  00:11:22:33:44:55  ');
    expect($mac->value())->toBe('00:11:22:33:44:55');
});

it('throws on an invalid MAC address', function (): void {
    new MacAddress('not-a-mac');
})->throws(InvalidArgumentException::class);

it('throws on an empty string', function (): void {
    new MacAddress('');
})->throws(InvalidArgumentException::class);

it('compares two equal MAC addresses as equal', function (): void {
    $a = new MacAddress('00:11:22:33:44:55');
    $b = new MacAddress('00:11:22:33:44:55');
    expect($a->equals($b))->toBeTrue();
});

it('compares two different MAC addresses as not equal', function (): void {
    $a = new MacAddress('00:11:22:33:44:55');
    $b = new MacAddress('AA:BB:CC:DD:EE:FF');
    expect($a->equals($b))->toBeFalse();
});

it('casts to string', function (): void {
    $mac = new MacAddress('00:11:22:33:44:55');
    expect((string) $mac)->toBe('00:11:22:33:44:55');
});

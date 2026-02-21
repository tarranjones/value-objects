<?php

declare(strict_types=1);

use InvalidArgumentException;
use Tarranjones\ValueObjects\Ip;

it('accepts a valid IPv4 address', function (): void {
    $ip = new Ip('192.168.1.1');
    expect($ip->value())->toBe('192.168.1.1');
});

it('accepts a valid IPv6 address', function (): void {
    $ip = new Ip('::1');
    expect($ip->value())->toBe('::1');
});

it('trims surrounding whitespace', function (): void {
    $ip = new Ip('  192.168.1.1  ');
    expect($ip->value())->toBe('192.168.1.1');
});

it('throws on an invalid IP address', function (): void {
    new Ip('not-an-ip');
})->throws(InvalidArgumentException::class);

it('throws on an empty string', function (): void {
    new Ip('');
})->throws(InvalidArgumentException::class);

it('accepts IPv4 when FILTER_FLAG_IPV4 is set', function (): void {
    $ip = new Ip('10.0.0.1', FILTER_FLAG_IPV4);
    expect($ip->value())->toBe('10.0.0.1');
});

it('rejects IPv6 when FILTER_FLAG_IPV4 is set', function (): void {
    new Ip('::1', FILTER_FLAG_IPV4);
})->throws(InvalidArgumentException::class);

it('accepts IPv6 when FILTER_FLAG_IPV6 is set', function (): void {
    $ip = new Ip('2001:db8::1', FILTER_FLAG_IPV6);
    expect($ip->value())->toBe('2001:db8::1');
});

it('rejects IPv4 when FILTER_FLAG_IPV6 is set', function (): void {
    new Ip('192.168.1.1', FILTER_FLAG_IPV6);
})->throws(InvalidArgumentException::class);

it('compares two equal IPs as equal', function (): void {
    $a = new Ip('192.168.1.1');
    $b = new Ip('192.168.1.1');
    expect($a->equals($b))->toBeTrue();
});

it('compares two different IPs as not equal', function (): void {
    $a = new Ip('192.168.1.1');
    $b = new Ip('10.0.0.1');
    expect($a->equals($b))->toBeFalse();
});

it('casts to string', function (): void {
    $ip = new Ip('192.168.1.1');
    expect((string) $ip)->toBe('192.168.1.1');
});

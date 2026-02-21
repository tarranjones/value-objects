<?php

declare(strict_types=1);

use InvalidArgumentException;
use Tarranjones\ValueObjects\Domain;

it('accepts a valid domain', function (): void {
    $domain = new Domain('example.com');
    expect($domain->value())->toBe('example.com');
});

it('accepts a subdomain', function (): void {
    $domain = new Domain('sub.example.com');
    expect($domain->value())->toBe('sub.example.com');
});

it('trims surrounding whitespace', function (): void {
    $domain = new Domain('  example.com  ');
    expect($domain->value())->toBe('example.com');
});

it('throws on a domain with spaces', function (): void {
    new Domain('not a domain');
})->throws(InvalidArgumentException::class);

it('throws on an empty string', function (): void {
    new Domain('');
})->throws(InvalidArgumentException::class);

it('compares two equal domains as equal', function (): void {
    $a = new Domain('example.com');
    $b = new Domain('example.com');
    expect($a->equals($b))->toBeTrue();
});

it('compares two different domains as not equal', function (): void {
    $a = new Domain('example.com');
    $b = new Domain('other.com');
    expect($a->equals($b))->toBeFalse();
});

it('casts to string', function (): void {
    $domain = new Domain('example.com');
    expect((string) $domain)->toBe('example.com');
});

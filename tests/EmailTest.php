<?php

declare(strict_types=1);

use InvalidArgumentException;
use Tarranjones\ValueObjects\Email;

it('accepts a valid email address', function (): void {
    $email = new Email('user@example.com');
    expect($email->value())->toBe('user@example.com');
});

it('trims surrounding whitespace', function (): void {
    $email = new Email('  user@example.com  ');
    expect($email->value())->toBe('user@example.com');
});

it('throws on an invalid email address', function (): void {
    new Email('not-an-email');
})->throws(InvalidArgumentException::class);

it('throws on an empty string', function (): void {
    new Email('');
})->throws(InvalidArgumentException::class);

it('compares two equal emails as equal', function (): void {
    $a = new Email('user@example.com');
    $b = new Email('user@example.com');
    expect($a->equals($b))->toBeTrue();
});

it('compares two different emails as not equal', function (): void {
    $a = new Email('user@example.com');
    $b = new Email('other@example.com');
    expect($a->equals($b))->toBeFalse();
});

it('casts to string', function (): void {
    $email = new Email('user@example.com');
    expect((string) $email)->toBe('user@example.com');
});

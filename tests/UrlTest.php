<?php

declare(strict_types=1);

use InvalidArgumentException;
use Tarranjones\ValueObjects\Url;

it('accepts a valid URL', function (): void {
    $url = new Url('https://example.com');
    expect($url->value())->toBe('https://example.com');
});

it('trims surrounding whitespace', function (): void {
    $url = new Url('  https://example.com  ');
    expect($url->value())->toBe('https://example.com');
});

it('throws on an invalid URL', function (): void {
    new Url('not a url');
})->throws(InvalidArgumentException::class);

it('throws on an empty string', function (): void {
    new Url('');
})->throws(InvalidArgumentException::class);

it('accepts a URL with path and query when FILTER_FLAG_PATH_REQUIRED and FILTER_FLAG_QUERY_REQUIRED are passed', function (): void {
    $url = new Url('https://example.com/path?query=1', FILTER_FLAG_PATH_REQUIRED | FILTER_FLAG_QUERY_REQUIRED);
    expect($url->value())->toBe('https://example.com/path?query=1');
});

it('rejects a URL without a path when FILTER_FLAG_PATH_REQUIRED is set', function (): void {
    new Url('https://example.com', FILTER_FLAG_PATH_REQUIRED);
})->throws(InvalidArgumentException::class);

it('compares two equal URLs as equal', function (): void {
    $a = new Url('https://example.com');
    $b = new Url('https://example.com');
    expect($a->equals($b))->toBeTrue();
});

it('compares two different URLs as not equal', function (): void {
    $a = new Url('https://example.com');
    $b = new Url('https://other.com');
    expect($a->equals($b))->toBeFalse();
});

it('casts to string', function (): void {
    $url = new Url('https://example.com');
    expect((string) $url)->toBe('https://example.com');
});

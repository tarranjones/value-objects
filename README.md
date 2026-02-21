# tarranjones/value-objects

Type-safe PHP Value Objects backed by `filter_var` validation and integer constraints.

## Requirements

- PHP 8.2+

## Installation

```bash
composer require tarranjones/value-objects
```

## Value Objects

### String VOs

| Class | Validates |
|---|---|
| `Email` | Email address |
| `Url` | URL |
| `Ip` | IPv4 or IPv6 address |
| `Domain` | Domain / hostname |
| `MacAddress` | MAC address |

### Integer VOs

| Class | Rule |
|---|---|
| `PositiveInt` | `> 0` |
| `NegativeInt` | `< 0` |
| `NonNegativeInt` | `>= 0` |
| `NonPositiveInt` | `<= 0` |
| `MinInt` | `>= $min` |
| `MaxInt` | `<= $max` |
| `ClampedInt` | `$min <= value <= $max` |

## Usage

All VOs share a consistent API: `value()`, `equals(self $other)`, and `(string)` casting. String VOs trim surrounding whitespace. Every invalid input throws `\InvalidArgumentException`.

### String VOs

```php
use Tarranjones\ValueObjects\Email;
use Tarranjones\ValueObjects\Url;
use Tarranjones\ValueObjects\Ip;
use Tarranjones\ValueObjects\Domain;
use Tarranjones\ValueObjects\MacAddress;

$email = new Email('user@example.com');
$email->value(); // 'user@example.com'

// Optional filter_var flags
$url = new Url('https://example.com/path?q=1', FILTER_FLAG_PATH_REQUIRED | FILTER_FLAG_QUERY_REQUIRED);

// Restrict to IPv6 only
$ip = new Ip('::1', FILTER_FLAG_IPV6);

// isHostname=true (default) enforces RFC hostname rules
$domain = new Domain('example.com');
// isHostname=false relaxes validation
$domain = new Domain('example', isHostname: false);

$mac = new MacAddress('00:11:22:33:44:55');
```

### Integer VOs

```php
use Tarranjones\ValueObjects\PositiveInt;
use Tarranjones\ValueObjects\NegativeInt;
use Tarranjones\ValueObjects\NonNegativeInt;
use Tarranjones\ValueObjects\NonPositiveInt;
use Tarranjones\ValueObjects\MinInt;
use Tarranjones\ValueObjects\MaxInt;
use Tarranjones\ValueObjects\ClampedInt;

$qty   = new PositiveInt(5);          // 5
$temp  = new NegativeInt(-10);        // -10
$score = new NonNegativeInt(0);       // 0
$debt  = new NonPositiveInt(-50);     // -50

$age    = new MinInt(18, min: 0);
$rating = new MaxInt(4, max: 5);
$level  = new ClampedInt(3, min: 1, max: 10);

// MinInt / MaxInt expose their boundary
$age->min();    // 0
$rating->max(); // 5

// ClampedInt exposes both
$level->min(); // 1
$level->max(); // 10
```

### Equality & string casting

```php
$a = new Email('user@example.com');
$b = new Email('user@example.com');

$a->equals($b);   // true
(string) $a;      // 'user@example.com'
```

## License

MIT

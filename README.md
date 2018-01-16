# PhpAes

[![Build Status](https://travis-ci.org/phillipsdata/phpaes.svg?branch=master)](https://travis-ci.org/phillipsdata/phpaes)

FIPS-192 compliant AES cipher.

### Supported key lengths:
- 128 bits
- 192 bits
- 256 bits

### Support block modes:

- ECB: Electronic Code Book
- CBC: Cipher Block Chaining
- CFB: Cipher Feedback
- OFB: Output Feedback

### Supported padding schemes:

- null byte (0x00)


## Installation

Install via composer:

```sh
composer require phpaes/phpaes
```

## Basic Usage

```php
use PhpAes\Aes;

$aes = new Aes('abcdefgh01234567', 'CBC', '1234567890abcdef');

$y = $aes->encrypt('hello world!');
$x = $aes->decrypt($y);

echo base64_encode($y);
echo $x;
```

## Static Code Analysis

### Running Tests

```sh
vendor/bin/phpunit
```

### Code Style

This project adheres to PSR-2 formatting.

```sh
vendor/bin/phpcs --extensions=php --report=summary --standard=PSR2 ./src ./tests
```
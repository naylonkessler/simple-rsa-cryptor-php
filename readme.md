# SimpleRSACryptor

A simple toolset for working with RSA encryption in PHP.

## Installation

Just require the package using composer.

```sh
composer require naylonkessler/simple-rsa-cryptor-php
```

## Using the package

Just import, instantiate and call:

```php
<?php

use SimpleRSACryptor\Cryptor;

$publicKey = '...';
$privateKey = '...';
$passphrase = '...';

$cryptor = new Cryptor($publicKey, $privateKey, $passphrase);
$encrypted = $cryptor->encrypt('Some data');
$decrypted = $cryptor->decrypt($encrypted);

echo $decrypted;
```

### The \SimpleRSACryptor\Cryptor object

TDB


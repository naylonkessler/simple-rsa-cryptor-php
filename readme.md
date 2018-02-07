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
use SimpleRSACryptor\Keys\PublicKey;
use SimpleRSACryptor\Keys\PrivateKey;

$publicKey = new PublicKey('path-to-public-key-file.pem');
$privateKey = new PrivateKey('path-to-private-key-file.pem');
$passPhrase = 'pass phrase of private key';

$cryptor = new Cryptor($publicKey, $privateKey, $passPhrase);
$encrypted = $cryptor->encrypt('Some data');
$decrypted = $cryptor->decrypt($encrypted);

echo $decrypted;
```

### The \SimpleRSACryptor\Cryptor class

TBD

### The \SimpleRSACryptor\Keys\PublicKey class 

TBD

### The \SimpleRSACryptor\Keys\PrivateKey class

TBD

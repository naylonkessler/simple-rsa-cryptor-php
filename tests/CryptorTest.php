<?php

namespace Test;

use PHPUnit\Framework\TestCase;

class CryptorTest extends TestCase
{
    /**
     * @return \SimpleRSACryptor\Cryptor
     */
    public function testInstance()
    {
        $publicKey = new \SimpleRSACryptor\Keys\PublicKey('./tests/test-keys/public.pem');
        $privateKey = new \SimpleRSACryptor\Keys\PrivateKey('./tests/test-keys/private.pem');
        $passPhrase = '123456';
        $cryptor = new \SimpleRSACryptor\Cryptor($publicKey, $privateKey, $passPhrase);

        $this->assertInstanceOf(\SimpleRSACryptor\Cryptor::class, $cryptor);
        $this->assertAttributeEquals($publicKey, 'publicKey', $cryptor);
        $this->assertAttributeEquals($privateKey, 'privateKey', $cryptor);
        $this->assertAttributeEquals($passPhrase, 'passPhrase', $cryptor);

        return $cryptor;
    }

    /**
     * @depends testInstance
     */
    public function testEncrypting($cryptor)
    {
        $data = 'Some data';
        $encrypted = $cryptor->encrypt($data);

        $this->assertNotEquals($encrypted, $data);
        $this->assertTrue(strlen($encrypted) > 0);

        return [$cryptor, $encrypted];
    }

    /**
     * @depends testEncrypting
     */
    public function testDecrypting($dependencies)
    {
        list($cryptor, $encrypted) = $dependencies;

        $data = 'Some data';
        $decrypted = $cryptor->decrypt($encrypted);

        $this->assertEquals($data, $decrypted);
    }

    /**
     * @depends testInstance
     */
    public function testEncryptingWithBase64($cryptor)
    {
        $data = 'Some data';
        $encrypted = $cryptor->encryptWithBase64($data);

        $this->assertNotEquals($encrypted, $data);
        $this->assertTrue(strlen($encrypted) > 0);

        return [$cryptor, $encrypted];
    }

    /**
     * @depends testEncryptingWithBase64
     */
    public function testDecryptingWithBase64($dependencies)
    {
        list($cryptor, $encrypted) = $dependencies;

        $data = 'Some data';
        $decrypted = $cryptor->decryptWithBase64($encrypted);

        $this->assertEquals($data, $decrypted);
    }

    // Test keypair generation
}

<?php

namespace Test\Keys;

use PHPUnit\Framework\TestCase;

class PrivateKeyTest extends TestCase
{
    /**
     * @return \SimpleRSACryptor\Keys\PrivateKey
     */
    public function testInstance()
    {
        $filePath = './tests/test-keys/private.pem';
        $realFilePath = dirname(__DIR__) . '/test-keys/private.pem';
        $key = new \SimpleRSACryptor\Keys\PrivateKey($filePath);

        $this->assertInstanceOf(\SimpleRSACryptor\Keys\PrivateKey::class, $key);
        $this->assertInstanceOf(\SimpleRSACryptor\Keys\Key::class, $key);
        $this->assertAttributeEquals($realFilePath, 'filePath', $key);

        return $key;
    }

    /**
     * @depends testInstance
     */
    public function testGettingContents($key)
    {
        $contents = $key->contents();
        $found = (bool) preg_match('/BEGIN RSA PRIVATE KEY/', $contents);

        $this->assertTrue($found);
    }

    /**
     * @depends testInstance
     */
    public function testLoadingContents($key)
    {
        $originalContent = '-----RANDOM CONTENT-----';

        $key->load($originalContent);

        $contents = $key->contents();

        $this->assertEquals($originalContent, $contents);
    }

    public function testToString()
    {
        $filePath = './tests/test-keys/private.pem';
        $key = new \SimpleRSACryptor\Keys\PrivateKey($filePath);

        $contents = (string) $key;
        $found = (bool) preg_match('/BEGIN RSA PRIVATE KEY/', $contents);

        $this->assertTrue($found);
    }
}

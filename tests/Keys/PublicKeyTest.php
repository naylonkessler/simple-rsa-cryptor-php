<?php

namespace Test\Keys;

use PHPUnit\Framework\TestCase;

class PublicKeyTest extends TestCase
{
    /**
     * @return \SimpleRSACryptor\Keys\PublicKey
     */
    public function testInstance()
    {
        $filePath = './tests/test-keys/public.pem';
        $realFilePath = dirname(__DIR__) . '/test-keys/public.pem';
        $key = new \SimpleRSACryptor\Keys\PublicKey($filePath);

        $this->assertInstanceOf(\SimpleRSACryptor\Keys\PublicKey::class, $key);
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
        $found = (bool) preg_match('/BEGIN PUBLIC KEY/', $contents);

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
        $filePath = './tests/test-keys/public.pem';
        $key = new \SimpleRSACryptor\Keys\PublicKey($filePath);

        $contents = (string) $key;
        $found = (bool) preg_match('/BEGIN PUBLIC KEY/', $contents);

        $this->assertTrue($found);
    }
}

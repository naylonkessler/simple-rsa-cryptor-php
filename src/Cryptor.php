<?php

namespace SimpleRSACryptor;

use SimpleRSACryptor\Keys\Key;

/**
 * Class Cryptor.
 *
 * This class is the main class of toolset. It acts as a hub for the toolset
 * operations.
 *
 * @package SimpleRSACryptor
 * @author Naylon Kessler de Aquino <naylon.kessler@gmail.com>
 */
class Cryptor
{
    /**
     * The pass phrase for private key.
     *
     * @var mixed
     */
    protected $passPhrase;

    /**
     * The private key.
     *
     * @var \SimpleRSACryptor\Keys\Key
     */
    protected $privateKey;

    /**
     * The public key.
     *
     * @var \SimpleRSACryptor\Keys\Key
     */
    protected $publicKey;

    /**
     * Cryptor constructor.
     *
     * Initializes the class dependencies.
     *
     * @param \SimpleRSACryptor\Keys\Key $publicKey
     * @param \SimpleRSACryptor\Keys\Key $privateKey
     * @param mixed $passPhrase
     */
    public function __construct(Key $publicKey, Key $privateKey, $passPhrase = null)
    {
        $this->passPhrase = $passPhrase;
        $this->privateKey = $privateKey;
        $this->publicKey = $publicKey;
    }

    /**
     * Decrypts some encrypted data using the private key.
     *
     * @param mixed $data
     * @return mixed
     */
    public function decrypt($data)
    {
        $privateKey = openssl_pkey_get_private(
            $this->privateKey->contents(),
            $this->passPhrase
        );

        openssl_private_decrypt($data, $decrypted, $privateKey);

        return $decrypted;
    }

    /**
     * Decrypts some encrypted and base64 encoded data using the private key.
     *
     * @param mixed $data
     * @return mixed
     */
    public function decryptWithBase64($data)
    {
        return $this->decrypt(base64_decode($data));
    }

    /**
     * Encrypts some data using the public key.
     *
     * @param mixed $data
     * @return mixed
     */
    public function encrypt($data)
    {
        openssl_public_encrypt($data, $encrypted, $this->publicKey->contents());

        return $encrypted;
    }

    /**
     * Encrypts and encode with base64 some data using the public key.
     *
     * @param mixed $data
     * @return mixed
     */
    public function encryptWithBase64($data)
    {
        return base64_encode($this->encrypt($data));
    }
}

<?php

namespace SimpleRSACryptor\Keys;

/**
 * Interface Key.
 *
 * Contracts that defines the public API of keys classes.
 *
 * @package SimpleRSACryptor\Keys
 * @author Naylon Kessler de Aquino <naylon.kessler@gmail.com>
 */
interface Key
{
    /**
     * Return the contents of key.
     *
     * @return string
     */
    public function contents();

    /**
     * Loads the contents of key.
     *
     * @param string $keyContents
     */
    public function load($keyContents);

    /**
     * Returns the string representation of key.
     *
     * @return mixed
     */
    public function __toString();
}

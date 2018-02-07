<?php

namespace SimpleRSACryptor\Keys;

/**
 * Class BaseKey.
 *
 * Base abstraction of keys contents.
 *
 * @package SimpleRSACryptor\Keys
 * @author Naylon Kessler de Aquino <naylon.kessler@gmail.com>
 */
abstract class BaseKey
{
    /**
     * The contents of the key when loaded directly, without a file path.
     *
     * @var string
     */
    protected $contents;

    /**
     * The absolute file path where key file lives.
     *
     * @var string
     */
    protected $filePath;

    /**
     * PublicKey constructor.
     *
     * Initializes the class dependencies.
     *
     * @param string $filePath
     */
    public function __construct($filePath)
    {
        $this->setFilePath($filePath);
    }

    /**
     * Return the contents of key.
     *
     * @return string
     */
    public function contents()
    {
        if ($this->contents) {
            return $this->contents;
        }

        $key = null;
        $keyPath = realpath($this->filePath);

        if (file_exists($keyPath)) {
            $key = file_get_contents($keyPath);
        }

        return $key;
    }

    /**
     * Loads the contents of key.
     *
     * @param string $keyContents
     */
    public function load($keyContents)
    {
        $this->contents = $keyContents;
    }

    /**
     * Sets the absolute path of key file.
     *
     * @param string $filePath
     */
    protected function setFilePath($filePath)
    {
        $this->filePath = realpath($filePath);
    }

    /**
     * Returns the string representation of key.
     *
     * @return mixed
     */
    public function __toString()
    {
        return $this->contents();
    }
}

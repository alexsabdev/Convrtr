<?php

namespace Alexsabdev\Convrtr\Readers;

use Exception;

/**
 * Class Reader
 * @package Alexsabdev\Convrtr\Readers
 */
abstract class Reader implements ReaderInterface
{
    /**
     * @param string $path
     * @return string
     * @throws Exception
     */
    public function read(string $path) : string
    {
        if (!file_exists($path)) {
            throw new Exception('File ' . $path . ' doesn\'t exist');
        }

        $handle = fopen($path, 'rb');

        if (!$handle) {
            throw new Exception('File ' . $path . ' isn\'t readable');
        }

        $result = fread($handle, filesize($path));

        if (!$result) {
            throw new Exception('Error while reading a file ' . $path);
        }

        fclose($handle);

        return $result;
    }

    /**
     * @param string $str
     */
    abstract public function parse(string $str);
}

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
     * @param $path
     * @return string
     * @throws Exception
     */
    public function read($path)
    {
        if (!file_exists($path)) {
            throw new Exception('File ' . $path . ' doesn\'t exist');
        }

        $handle = fopen($path, 'rb');

        if (!$handle) {
            throw new Exception('File ' . $path . ' isn\'t readable');
        }

        $contents = fread($handle, filesize($path));

        if (!$contents) {
            throw new Exception('Error while reading a file ' . $path);
        }

        fclose($handle);

        return $contents;
    }

    /**
     * @param $str
     * @return array
     */
    abstract public function parse($str);
}

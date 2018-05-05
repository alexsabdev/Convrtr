<?php

namespace Alexsabdev\Convrtr\Readers;

/**
 * Interface ReaderInterface
 * @package Alexsabdev\Convrtr\Readers
 */
interface ReaderInterface
{
    /**
     * @param $path
     * @return string
     */
    public function read($path);

    /**
     * @param $str
     * @return array
     */
    public function parse($str);
}

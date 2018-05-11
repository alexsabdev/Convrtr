<?php

namespace Alexsabdev\Convrtr\Readers;

/**
 * Interface ReaderInterface
 * @package Alexsabdev\Convrtr\Readers
 */
interface ReaderInterface
{
    /**
     * @param string $path
     */
    public function read(string $path);

    /**
     * @param string $str
     */
    public function parse(string $str);
}

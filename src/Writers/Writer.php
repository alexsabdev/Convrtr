<?php

namespace Alexsabdev\Convrtr\Writers;

/**
 * Class Writer
 * @package Alexsabdev\Convrtr\Writers
 */
abstract class Writer implements WriterInterface
{
    /**
     * @param string $path
     * @param array $arr
     */
    abstract public function write(string $path, array $arr);
}
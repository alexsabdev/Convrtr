<?php

namespace Alexsabdev\Convrtr\Writers;

/**
 * Class Writer
 * @package Alexsabdev\Convrtr\Writers
 */
abstract class Writer implements WriterInterface
{
    /**
     * @param $path
     * @param array $arr
     * @return void
     */
    abstract public function write($path, array $arr);
}
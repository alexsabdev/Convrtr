<?php

namespace Alexsabdev\Convrtr\Writers;

/**
 * Interface WriterInterface
 * @package Alexsabdev\Writers
 */
interface WriterInterface
{
    /**
     * @param string $path
     * @param array $arr
     */
    public function write(string $path, array $arr);
}

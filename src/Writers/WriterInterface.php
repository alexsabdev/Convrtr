<?php

namespace Alexsabdev\Convrtr\Writers;

/**
 * Interface WriterInterface
 * @package Alexsabdev\Writers
 */
interface WriterInterface
{
    /**
     * @param $path
     * @param array $arr
     * @return void
     */
    public function write($path, array $arr);
}

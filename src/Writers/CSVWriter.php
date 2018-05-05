<?php

namespace Alexsabdev\Convrtr\Writers;

use Exception;

/**
 * Class CSVWriter
 * @package Alexsabdev\Convrtr\Writers
 */
class CSVWriter extends Writer
{
    /**
     * @param $path
     * @param array $arr
     * @return void
     * @throws Exception
     */
    public function write($path, array $arr)
    {
        $handle = fopen($path, 'wb');

        if (!$handle) {
            throw new Exception('File ' . $path . ' isn\'t writable');
        }

        $keys = $this->keys($arr);
        fputcsv($handle, $keys);

        foreach ($arr as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);
    }

    /**
     * @param array $arr
     * @return array
     */
    private function keys(array $arr) {
        $result = [];

        foreach ($arr as $item) {
            $result = array_merge($result, array_keys($item));
        }

        $result = array_unique($result);
        sort($result);

        return $result;
    }
}
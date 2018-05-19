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
     * @param string $path
     * @param array $arr
     * @throws Exception
     * @return void
     */
    public function write(string $path, array $arr) : void
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
    private function keys(array $arr) : array
    {
        $result = [];

        foreach ($arr as $item) {
            $result = array_merge($result, array_keys($item));
        }

        $result = array_unique($result);
        sort($result);

        return $result;
    }
}

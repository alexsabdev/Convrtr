<?php

namespace Alexsabdev\Convrtr\Readers;

use Exception;

/**
 * Class CSVReader
 * @package alexsabdev\convrtr\Readers
 */
class CSVReader extends Reader
{
    /**
     * @param $str
     * @return array
     * @throws Exception
     */
    public function parse($str)
    {
        $result = [];
        $arr = str_getcsv($str, PHP_EOL);

        if (!$arr) {
            throw new Exception('Empty CSV file');
        }

        foreach ($arr as $row) {
            $result[] = str_getcsv($row);
        }

        return $result;
    }

    /**
     * @param array $arr
     * @return array
     */
    public function normalize(array $arr) {
        $result = [];

        $headers = isset($arr[0]) ? $arr[0] : [];

        $first = true;
        foreach ($arr as $rowKey => $row) {
            if ($first) {
                $first = false;
                continue;
            }

            foreach ($headers as $headerKey => $header) {
                $result[$rowKey - 1][$header] = $row[$headerKey];
            }
        }

        return $result;
    }
}
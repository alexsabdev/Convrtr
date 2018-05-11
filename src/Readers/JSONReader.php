<?php

namespace Alexsabdev\Convrtr\Readers;

use Exception;

class JSONReader extends Reader
{
    /**
     * @param string $str
     * @return array
     * @throws Exception
     */
    public function parse(string $str) : array
    {
        $result = json_decode($str, true);

        if (!is_array($result)) {
            throw new Exception('Error while parsing a JSON');
        }

        if (array_keys($result) !== range(0, count($result) - 1)) {
            $result = [ $result ];
        }

        return $result;
    }

    /**
     * @param array $arr
     * @return array
     */
    public function normalize(array $arr) : array
    {
        $result = [];
        $flatArr = [];

        foreach ($arr as $item) {
            $flatArr[] = $this->flatten($item);
        }

        $keys = $this->keys($flatArr);

        foreach ($flatArr as $itemKey => $item) {
            foreach ($keys as $key) {
                $result[$itemKey][$key] = isset($flatArr[$itemKey][$key]) ? $flatArr[$itemKey][$key] : '';
            }
        }

        return $result;
    }

    /**
     * @param array $arr
     * @param string $prefix
     * @return array
     */
    private function flatten(array $arr, string $prefix = '') : array
    {
        $result = [];

        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                if (array_keys($val) === range(0, count($val) - 1)) {
                    $result[$prefix . $key] = implode(',', $val);
                    continue;
                }
                $result = array_merge($result, $this->flatten($val, $prefix . $key . '.'));
                continue;
            }

            $result[$prefix . $key] = $val;
        }

        return $result;
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

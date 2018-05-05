<?php

namespace Alexsabdev\Convrtr\Readers;

use Exception;

class JSONReader extends Reader
{
    /**
     * @param $str
     * @return array
     * @throws Exception
     */
    public function parse($str)
    {
        $arr = json_decode($str, true);

        if (!is_array($arr)) {
            throw new Exception('Error while parsing a JSON');
        }

        if (array_keys($arr) !== range(0, count($arr) - 1)) {
            $arr = [ $arr ];
        }

        return $arr;
    }

    /**
     * @param array $arr
     * @return array
     */
    public function normalize(array $arr) {
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
    private function flatten(array $arr, $prefix = '') {
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

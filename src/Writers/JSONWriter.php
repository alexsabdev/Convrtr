<?php

namespace Alexsabdev\Convrtr\Writers;

use Exception;

/**
 * Class JSONWriter
 * @package alexsabdev\convrtr\Writers
 */
class JSONWriter extends Writer
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

        $json = json_encode($arr, JSON_PRETTY_PRINT);

        if (!$json) {
            throw new Exception('Error while encoding to JSON');
        }

        fwrite($handle, $json);

        fclose($handle);
    }
}

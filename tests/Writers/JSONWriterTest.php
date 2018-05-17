<?php

namespace Alexsabdev\Convrtr\Tests\Writers;

use Alexsabdev\Convrtr\Writers\JSONWriter;
use PHPUnit\Framework\TestCase;

/**
 * Class JSONWriterTest
 * @package Alexsabdev\Convrtr\Tests\Writers
 */
class JSONWriterTest extends TestCase
{
    const TEST_FILE_PATH = 'test.json';

    public function testJSONWriterShouldWriteToJSON()
    {
        $writer = new JSONWriter();

        $arr = [
            [
                'one' => '1',
                'three.five' => '',
                'three.four' => '',
                'three.six' => '',
                'two' => '2',
            ],
            [
                'one' => '',
                'three.five' => '5',
                'three.four' => '4',
                'three.six' => '6,66',
                'two' => '22',
            ],
        ];

        $writer->write(self::TEST_FILE_PATH, $arr);

        $handle = fopen(self::TEST_FILE_PATH, 'rb');
        $contents = fread($handle, filesize(self::TEST_FILE_PATH));
        $json = json_decode($contents, true);
        fclose($handle);
        $this->assertEquals($arr, $json);
    }

    public function tearDown()
    {
        unlink(self::TEST_FILE_PATH);
    }
}

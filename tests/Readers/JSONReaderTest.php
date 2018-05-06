<?php

namespace Alexsabdev\Convrtr\Tests\Readers;

use Alexsabdev\Convrtr\Readers\JSONReader;
use PHPUnit\Framework\TestCase;

/**
 * Class JSONReaderTest
 * @package Alexsabdev\Convrtr\Tests\Readers
 */
class JSONReaderTest extends TestCase
{
    const TEST_FILE_PATH = 'test.json';
    const TEST_JSON_STR = '[
        {
            "one":1,
            "two":2
        },
        {
            "two":22,
            "three":{
                "four":4,
                "five":5,
                "six":[6, 66]
            }
        }
    ]';

    public function setUp()
    {
        $handle = fopen(self::TEST_FILE_PATH, 'wb');
        fwrite($handle, self::TEST_JSON_STR);
    }

    public function testJSONReaderShouldReadAndNormalizeJSON()
    {
        $reader = new JSONReader();

        $str = $reader->read(self::TEST_FILE_PATH);
        $this->assertEquals(self::TEST_JSON_STR, $str);

        $arr = $reader->parse($str);
        $this->assertEquals(
            [
                [
                    'one' => 1,
                    'two' => 2,
                ],
                [
                    'two' => 22,
                    'three' => [
                        'four' => 4,
                        'five' => 5,
                        'six' => [6, 66]
                    ],
                ],
            ],
            $arr
        );

        $normArr = $reader->normalize($arr);
        $this->assertEquals(
            [
                [
                    'one' => 1,
                    'three.five' => '',
                    'three.four' => '',
                    'three.six' => '',
                    'two' => 2,
                ],
                [
                    'one' => '',
                    'three.five' => 5,
                    'three.four' => 4,
                    'three.six' => '6,66',
                    'two' => 22,
                ],
            ],
            $normArr
        );
    }

    public function tearDown()
    {
        unlink(self::TEST_FILE_PATH);
    }
}
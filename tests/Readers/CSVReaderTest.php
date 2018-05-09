<?php

namespace Alexsabdev\Convrtr\Tests\Readers;

use Alexsabdev\Convrtr\Readers\CSVReader;
use PHPUnit\Framework\TestCase;

/**
 * Class CSVReaderTest
 * @package Alexsabdev\Convrtr\Tests\Readers
 */
class CSVReaderTest extends TestCase
{

    const TEST_FILE_PATH = 'test.csv';
    private $testCSVArr = [
        'one,three.five,three.four,three.six,two',
        '1,,,,2',
        ',5,4,"6,66",22',
    ];

    public function setUp()
    {
        $handle = fopen(self::TEST_FILE_PATH, 'wb');
        fwrite($handle, implode(PHP_EOL, $this->testCSVArr));
    }

    public function testCSVReaderShouldReadCSV()
    {
        $reader = new CSVReader();

        $str = $reader->read(self::TEST_FILE_PATH);
        $this->assertEquals(implode(PHP_EOL, $this->testCSVArr), $str);

        $arr = $reader->parse($str);
        $this->assertEquals(
            [
                ['one','three.five','three.four','three.six','two'],
                ['1','','','','2'],
                ['','5','4','6,66','22']
            ],
            $arr
        );

        $normArr = $reader->normalize($arr);
        $this->assertEquals(
            [
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
            ],
            $normArr
        );
    }

    public function tearDown()
    {
        unlink(self::TEST_FILE_PATH);
    }
}
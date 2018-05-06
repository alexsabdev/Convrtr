<?php

namespace Alexsabdev\Convrtr\Tests\Writers;

use Alexsabdev\Convrtr\Writers\CSVWriter;
use PHPUnit\Framework\TestCase;

class CSVWriterTest extends TestCase
{
    const TEST_FILE_PATH = 'test.csv';

    public function testCSVWriterShouldSaveNormalizedArrayToCSV()
    {
        $writer = new CSVWriter();

        $arr = [
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
        ];

        $writer->write(self::TEST_FILE_PATH, $arr);

        $handle = fopen(self::TEST_FILE_PATH, 'rb');
        $csv = [];

        while (!feof($handle)) {
            $csv[] = fgetcsv($handle);
        }

        $this->assertEquals(
            ['one', 'three.five', 'three.four', 'three.six', 'two'],
            $csv[0]
        );

        $this->assertEquals(
            ['', 5, 4, '6,66', 22],
            $csv[2]
        );


    }

    public function tearDown()
    {
        unlink(self::TEST_FILE_PATH);
    }
}
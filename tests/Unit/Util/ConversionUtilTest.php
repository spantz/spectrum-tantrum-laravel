<?php


namespace Tests\Unit\Util;


use App\Util\ConversionUtil;
use Tests\TestCase;

class ConversionUtilTest extends TestCase
{

    public function testConvertBitsToBytes()
    {
        $kilobytes = 1;
        $kilobits = 8;

        $this->assertEquals($kilobytes, ConversionUtil::convertBitsToBytes($kilobits));
    }

    public function testConvertBytesToBits()
    {
        $kilobytes = 1;
        $kilobits = 8;

        $this->assertEquals($kilobits, ConversionUtil::convertBytesToBits($kilobytes));
    }

    public function testConvertKiloToMega()
    {
        $megabits = 1;
        $kilobits = 1000;

        $this->assertEquals($megabits, ConversionUtil::convertKiloToMega($kilobits));
    }

    public function testConvertMegaToKilo()
    {
        $megabits = 1;
        $kilobits = 1000;
        $this->assertEquals($kilobits, ConversionUtil::convertMegaToKilo($megabits));
    }

    public function testConvertKilobitsToMegabytes()
    {
        $kilobits = 8000;
        $megabytes = 1;
        $this->assertEquals($megabytes, ConversionUtil::convertKilobitsToMegabytes($kilobits));
    }

    public function testConvertMegabytesToKilobits()
    {
        $kilobits = 8000;
        $megabytes = 1;
        $this->assertEquals($kilobits, ConversionUtil::convertMegabytesToKilobits($megabytes));
    }

    public function testConvertMegabitsToKilobytes()
    {
        $megabits = 1;
        $kilobytes = 125;
        $this->assertEquals($kilobytes, ConversionUtil::convertMegabitsToKilobytes($megabits));
    }

    public function testConvertKilobytesToMegabits()
    {
        $megabits = 1;
        $kilobytes = 125;
        $this->assertEquals($megabits, ConversionUtil::convertKilobytesToMegabits($kilobytes));
    }

}
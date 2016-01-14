<?php
namespace Workshop\Numerals;
class RomanTest extends \PHPUnit_Framework_TestCase {
/**
* @test
* @dataProvider arabicProvider
*/
public function arabicToRoman($input, $expected){
$roman = new Roman();
$result = $roman->arabicToRoman($input);
$this->assertEquals($expected, $result, ":D");
}
public function arabicProvider(){
return array(
array(1,"I"),
array(10,"X"),
array(6,"VI"),
array(4,"IV")
);
}
}

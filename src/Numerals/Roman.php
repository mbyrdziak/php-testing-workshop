<?php
namespace Workshop\Numerals;

class Roman {

    private static $numerals = array(
        10 => 'X',
        9 => 'IX',
        5 => 'V',
        4 => 'IV',
        1 => 'I'
    );

    public function arabicToRoman($arabic)
    {
        $result = '';

        foreach(self::$numerals as $arabicNumeral => $romanNumeral) {
            while ($arabic >= $arabicNumeral) {
                $arabic -= $arabicNumeral;
                $result .= $romanNumeral;
            }
        }

        return $result;
    }
}
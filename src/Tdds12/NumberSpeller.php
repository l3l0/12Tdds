<?php

namespace Tdds12;

class NumberSpeller
{
    private $basicNumbers = array(
        0 => 'zero',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        14 => 'fourteen',
        15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen',
        18 => 'eighteen',
        19 => 'nineteen',
        20 => 'twenty',
        30 => 'thirty',
        40 => 'forty',
        50 => 'fifty',
        60 => 'sixty',
        70 => 'seventy',
        80 => 'eighty',
        90 => 'ninety',
    );

    public function spellOut($number)
    {
        if ($this->isBasicNumber($number)) {
            return $this->basicNumbers[$number];
        }

        if ($number < 100) {
            return $this->spellOutHundredNumber($number);
        }

        return $this->spellOutNumber($number);
    }

    protected function spellOutHundredNumber($number)
    {
        $numberArray = $this->convertNumberToArray($number);

        return sprintf(
            '%s %s',
            $this->spellOut((int) $numberArray[0].'0'),
            $this->spellOut((int) $numberArray[1])
        );
    }

    protected function spellOutNumber($number)
    {
        $numberArray = $this->convertNumberToArray($number);
        $numberCount = count($numberArray);
        $size = $this->getPrefixNumberSize($numberCount);

        $prefix = sprintf(
            '%s %s',
            $this->spellOut($this->convertArrayToNumber($numberArray, 0, $size)),
            $this->getPrefix($number)
        );

        $restOfNumber = $this->convertArrayToNumber($numberArray, $size + 1, $numberCount - 1);
        $lastDigit = end($numberArray);

        if ($restOfNumber > 101 && $lastDigit > 0) {
            return sprintf('%s, %s', $prefix, $this->spellOut($restOfNumber));
        }
        if ($restOfNumber > 101) {
            return sprintf('%s and %s', $prefix, $this->spellOut($restOfNumber));
        }
        if ($restOfNumber > 12) {
            return sprintf('%s %s', $prefix, $this->spellOut($restOfNumber));
        }
        if ($restOfNumber > 9) {
            return sprintf('%s and %s', $prefix, $this->spellOut($restOfNumber));
        }
        if ($restOfNumber > 0) {
            return sprintf('%s and %s', $prefix, $this->spellOut($lastDigit));
        }

        return $prefix;
    }

    protected function getPrefix($number)
    {
        if ($number < 1000) {
            return 'hundred';
        }

        if ($number < 1000000) {
            return 'thousand';
        }

        if ($number < 1000000000) {
            return 'million';
        }

        if ($number < 1000000000000) {
            return 'billion';
        }

        if ($number < 1000000000000000) {
            return 'trillion';
        }

        if ($number < 1000000000000000000) {
            return 'quadrillion';
        }
    }

    private function isBasicNumber($number)
    {
        return isset($this->basicNumbers[$number]);
    }

    private function getPrefixNumberSize($numberCount)
    {
        $zeroNumbers = $numberCount - 1;

        if ($zeroNumbers > 3) {
            return $zeroNumbers % 3;
        }

        return 0;
    }

    private function convertNumberToArray($number)
    {
        return str_split((string) $number);
    }

    private function convertArrayToNumber($numberArray, $fromIndex, $toIndex = 0)
    {
        $number = '';

        if (!$toIndex) {
            return (int) $numberArray[$fromIndex];
        }

        for ($index = $fromIndex; $index <= $toIndex; ++$index) {
            $number .= $numberArray[$index];
        }

        return (int) $number;
    }
}

<?php

namespace Tdds12;

class CalcStats
{
    private $integerSequence = array();

    public function __construct($integerSequence)
    {
        $this->integerSequence = $integerSequence;
    }

    public function getMinimumValue()
    {
        return min($this->integerSequence);
    }

    public function getMaximumValue()
    {
        return max($this->integerSequence);
    }

    public function countNumberOfElements()
    {
        return count($this->integerSequence);
    }

    public function getAverageValue($precision = 6)
    {
        return round(array_sum($this->integerSequence) / $this->countNumberOfElements(), $precision);
    }
}
